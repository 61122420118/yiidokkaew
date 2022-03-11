<?php

namespace backend\controllers;

use Yii;
use backend\models\Visa;
use backend\models\VisaDetail;
use backend\models\VisaDetailSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\VisaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Model;
use yii\filters\VerbFilter;

/**
 * VisaController implements the CRUD actions for Visa model.
 */
class VisaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Visa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VisaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Visa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
     
        $searchModel        = new VisaDetailSearch();
        $searchModel->visa_id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
       
    

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Visa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Visa();
        $modelVisaDetail = [new VisaDetail];
        $model->create_at = date('Y-m-d H:i:s');
        

        if ($model->load(Yii::$app->request->post())) {

            $modelVisaDetail = Model::createMultiple(VisaDetail::classname());
            Model::loadMultiple($modelVisaDetail, Yii::$app->request->post());

            // ajax validation
            /*if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMedicationDetail),
                    ActiveForm::validate($model)
                );
            }*/

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelVisaDetail) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelVisaDetail as $modelVisaDetails) {
                            $modelVisaDetails->visa_id = $model->profile_id ;
                            if (! ($flag = $modelVisaDetails->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        
    }  else {
     return $this->render('create', [
         'model' => $model,
         'modelVisaDetail' => (empty($modelVisaDetail)) ? [new VisaDetail] : $modelVisaDetail,

     ]);
 }
}

    /**
     * Updates an existing Visa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelVisaDetail = $model->visaDetails;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelVisaDetail, 'id', 'id');
            $modelVisaDetail = Model::createMultiple(VisaDetail::classname());
            Model::loadMultiple($modelVisaDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelVisaDetail, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelVisaDetail),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelVisaDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            VisaDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelVisaDetail as $modelVisaDetails) {
                            $modelVisaDetails->visa_id = $model->profile_id;
                            if (! ($flag = $modelVisaDetails->save(false))) {
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
        }

        return $this->render('update', [
            'model' => $model,
            'modelVisaDetail' => (empty($modelVisaDetail)) ? [new VisaDetail] : $modelVisaDetail
        ]);
    }

    /**
     * Deletes an existing Visa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Delete success');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Visa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
