<?php

namespace backend\controllers;
use Yii;
use backend\models\Relative;
use backend\models\RelativeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ProvinceDetail;
use backend\models\DistrictDetail;
use backend\models\SubdistrictDetail;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * RelativeController implements the CRUD actions for Relative model.
 */
class RelativeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Relative models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RelativeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Relative model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Relative model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Relative();
        $model->create_at = date('Y-m-d H:i:s');
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }  else {
         return $this->render('create', [
             'model' => $model,
             'district'=> [],
             'subdistrict' =>[]
         ]);
     }
 }

    /**
     * Updates an existing Relative model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $district         = ArrayHelper::map($this->getDistrict($model->rela_province),'id','name');
        $subdistrict       = ArrayHelper::map($this->getSubDistrict($model->rela_district),'id','name');


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Update Success');
        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
        return $this->render('update', [
            'model' => $model,
            'district'=> $district,
            'subdistrict' => $subdistrict,
        ]);
    }
    }

    /**
     * Deletes an existing Relative model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Delete success');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Relative model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Relative the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relative::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dt_province = $parents[0];
                $out = $this->getDistrict($dt_province);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetSubDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $dt_province = empty($ids[0]) ? null : $ids[0];
            $sd_district = empty($ids[1]) ? null : $ids[1];
            if ($dt_province != null) {
               $data = $this->getSubDistrict($sd_district);
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    
    protected function getDistrict($id){
        $datas = DistrictDetail::find()->where(['dt_province'=>$id])->Orderby('dt_name')->all();
        return $this->MapData($datas,'id','dt_name');
    }

    protected function getSubDistrict($id){
        $datas = SubdistrictDetail::find()->where(['sd_district' => $id])->Orderby('sd_name')->all();
        return $this->MapData($datas,'id','sd_name');
    }

    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }
}
