<?php

namespace backend\controllers;
use Yii;
use backend\models\Profile;
use backend\models\ProfileSearch;
use backend\models\RelativeSearch;
use backend\models\AllergiesSearch;
use backend\models\VisaDetailSearch;
use backend\models\AdmitSearch;
use backend\models\VisaDetail;
use backend\models\Visa;
use backend\models\Health;
use backend\models\Relative;
use backend\models\Physical;
use backend\models\Admit;
use backend\models\Allergies;
use backend\models\Medication;
use backend\models\MedicationDetail;
use backend\models\ProvinceDetail;
use backend\models\DistrictDetail;
use backend\models\SubdistrictDetail;
use backend\models\CountryDetail;
use backend\models\Model;

use kartik\mpdf\Pdf;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;



/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = new ProfileSearch();
        $searchModel        = new RelativeSearch();
        $searchModelvisa        = new VisaDetailSearch();
        $modelVisaDe = VisaDetail::findOne(['visa_id' => $id]);
        $searchModelvisa->visa_id = $id;
        $searchModel->profile_id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);


       
    

        return $this->render('view',array('model'=>$this->findModel($id),'dataProvider' => $dataProvider,'modelVisaDe'=>$modelVisaDe), [
            'model' => $this->findModel($id),
            'modelVisaDe' => $modelVisaDe,
            'dataProvider' => $dataProvider,


        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Profile();
        $modelVisa = new Visa();
        $modelAdmit = new Admit();
        $modelRelative = [new Relative];
        $modelHealth = new Health();
        $modelPhysical = new Physical();
        $modelAller = new Allergies();
        $modelMedication = new Medication();
        $model->create_at = date('Y-m-d H:i:s');
        $post = Yii::$app->request->post();
        $model->user = Yii::$app->user->identity->id;
        $model->usernames = Yii::$app->user->identity->username;
        
        if ($model->load($post)) {
            $model->save();
            if($modelVisa->load($post))
            {
                $modelVisa->profile_id = $model->id;
                $modelVisa->save();
            }

            if($modelPhysical->load($post))
            {
                $modelPhysical->profile_id = $model->id;
                $modelPhysical->save();
            }

            if($modelAdmit->load($post))
            {
                $modelAdmit->profile_id = $model->id;
                $modelAdmit->save();
            }

            if($modelAller->load($post))
            {
                $modelAller->profile_id = $model->id;
                $modelAller->save();
            }


            if($modelMedication->load($post))
            {
                $modelMedication->profile_id = $model->id;
                $modelMedication->save();
            }

            if($modelHealth->load($post))
            {
                $modelHealth->profile_id = $model->id;
                $modelHealth->save();
            }


            
            $modelRelative = Model::createMultiple(Relative::classname());
            Model::loadMultiple($modelRelative, Yii::$app->request->post());



            // ajax validation
            /*if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMedication),
                    ActiveForm::validate($model)
                );
            }*/

            // validate all models
            $code = "DK";
            $maxId = $model->id;   //<--- บรรทัดนี้เป็นเลขทดสอบ ตอนใช้จริงให้ ลบ! ออกด้วยนะครับ
            $maxId = substr("0000".$maxId, -4);
            $nextId = $code.$maxId;
            $model->dk_code = $nextId;
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelRelative) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelRelative as $modelRelatives) {
                            $modelRelatives->profile_id = $model->id ;
                            if (! ($flag = $modelRelatives->save(false))) {
                                $transaction->rollBack();
                                break;
                                }
                            }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Save success');
                        return Yii::$app->response->redirect(Url::to(['/visa/update', 'id' => $model->id],[ 'class' => 'btn btn-success']));
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            } 
        }  else {
         return $this->render('create', [
             'model' => $model,
             'modelVisa'=>$modelVisa,
             'modelMedication'=>$modelMedication,
             'modelHealth'=>$modelHealth,
             'modelAller'=>$modelAller,
             'modelAdmit'=>$modelAdmit,
             'modelPhysical'=>$modelPhysical,
             'modelRelative' => (empty($modelRelative)) ? [new Relative] : $modelRelative,

         ]);
     }
 }
      /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model        = $this->findModel($id);
        $modelRelative = $model->relatives;
        $modelVisa = $this->findModelVisa($model->id);
        $modelAdmit = $this->findModelAdmit($model->id);
        $modelHealth = $this->findModelHealth($model->id);
        $modelPhysical = $this->findModelPhysical($model->id);
        $modelAller = $this->findModelAller($model->id);
        $modelMedication = $this->findModelMedication($model->id);

        $post = Yii::$app->request->post();
        $model->user = Yii::$app->user->identity->id;
        $model->usernames = Yii::$app->user->identity->username;
 
        if ($model->load(Yii::$app->request->post())) {

            //$modelsRelative = Model::createMultiple(Relative::classname());
            //Model::loadMultiple($modelsRelative, Yii::$app->request->post());
            $oldIDs = ArrayHelper::map($modelRelative, 'id', 'id');
            $modelRelative = Model::createMultiple(Relative::classname());
            Model::loadMultiple($modelRelative, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelRelative, 'id', 'id')));

            // ajax validation
            /*if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsRelative),
                    ActiveForm::validate($model)
                );
            }*/

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelRelative) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Relative::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelRelative as $modelRelatives) {
                            $modelRelatives->profile_id = $model->id ;
                            if (! ($flag = $modelRelatives->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Update Success');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
              'model' => $model,
              'modelVisa'  => $modelVisa,
              'modelHealth'=>$modelHealth,
              'modelAller'=>$modelAller,
              'modelPhysical'=>$modelPhysical,
              'modelAdmit'=>$modelAdmit,
              'modelMedication'=>$modelMedication,
              'modelRelative' => (empty($modelRelative)) ? [new Relative] : $modelRelative,


            ]);
        }
    }

    /**
     * Deletes an existing Profile model.
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne(['id' => $id])) !== null) {
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

    public function getItemStatus()
    {
        $modelRelative = Relative::find()->where(['profile_id' => $this->id])->all();

    }

    public function actionPdf($id)
    {

        $searchModel        = new RelativeSearch();
        $searchModelphy        = new Physical();
        $searchModelheal        = new Health();
        $searchModelmedi        = new MedicationDetail();
        $searchModelvisa        = new VisaDetailSearch();
        $searchModelAllergies        = new AllergiesSearch();
        $searchModel->profile_id = $id;
        $searchModelphy->profile_id = $id;
        $searchModelmedi->med_id = $id;
        $searchModelheal->profile_id = $id;
        $searchModelAllergies->profile_id = $id;
        $searchModelvisa->visa_id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->setPagination(['pageSize' => 30]);
        $dataProvider->pagination = false; 
        $model = Profile::findOne(['id' => $id]);
        $modelPhysical = Physical::findOne(['profile_id' => $id]);
        $modelMedicatiob = MedicationDetail::findOne(['med_id' => $id]);
        $modelHealth = Health::findOne(['profile_id' => $id]);
        $modelAllergies = Allergies::findOne(['profile_id' => $id]);
        $modelRelative = Relative::findOne(['profile_id' => $id]);
        $modelVisaDe = VisaDetail::findOne(['visa_id' => $id]);

    
    
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_preview', [
            'model' => $model,
            'modelRelative' => $modelRelative,
            'modelAllergies' => $modelAllergies,
            'modelVisaDe' => $modelVisaDe,
            'modelPhysical' => $modelPhysical,
            'modelHealth' => $modelHealth,
            'dataProvider' => $dataProvider,
        ]);
    
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@backend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} ',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Report Case: '.$id],
            // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => 'Profile ' .$model->dk_code,
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Profile Info||Profile: ' .$model->dk_code],
                'SetFooter' => ['|page {PAGENO}|'],
                'SetAuthor' => 'SIE: Sistema de información Estudiantil',
                'SetCreator' => 'Juan Carlos Reyes Suazo',
//              'SetKeywords' => 'Sie, Yii2, Export, PDF, MPDF, Output, yii2-mpdf',
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);
    
        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    protected function findModelVisa($id)
{
    if (($model = Visa::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
protected function findModelAdmit($id)
{
    if (($model = Admit::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
protected function findModelPhysical($id)
{
    if (($model = Physical::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
protected function findModelHealth($id)
{
    if (($model = Health::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
protected function findModelAller($id)
{
    if (($model = Allergies::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
protected function findModelMedication($id)
{
    if (($model = Medication::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
}
