<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Medication;
use backend\models\Profile;
use backend\models\ProfileSearch;
use backend\models\Allergies;
use backend\models\AllergiesSearch;
use backend\models\MedicationDetail;
use backend\models\MedicationDetailSearch;
use backend\models\MedicationSearch;
use yii\helpers\Url;
use backend\models\Model;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedicationController implements the CRUD actions for Medication model.
 */
class MedicationController extends Controller
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
     * Lists all Medication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medication model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
     
        $searchModel        = new MedicationDetailSearch();
        $searchModel->med_id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
       
    

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Medication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medication();
        $modelMedication = [new MedicationDetail];
        $model->create_at = date('Y-m-d H:i:s');

        

        if ($model->load(Yii::$app->request->post())) {

            $modelMedication = Model::createMultiple(MedicationDetail::classname());
            Model::loadMultiple($modelMedication, Yii::$app->request->post());

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
            $valid = Model::validateMultiple($modelMedication) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelMedication as $modelMedications) {
                            $modelMedications->med_id = $model->profile_id ;
                            if (! ($flag = $modelMedications->save(false))) {
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
                //return $this->redirect(['view', 'id' => $model->id]);
        }  else {
        return $this->render('create', [
            'model' => $model,
            'modelMedication' => (empty($modelMedication)) ? [new MedicationDetail] : $modelMedication,
        ]);
    
    }
}

    /**
     * Updates an existing Medication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $modelMedication = $model->medDetails;



        if ($model->load(Yii::$app->request->post())){

        
    
    
            //$modelsMedDetail = Model::createMultiple(MedDetail::classname());
            //Model::loadMultiple($modelsMedDetail, Yii::$app->request->post());
            $oldIDs = ArrayHelper::map($modelMedication, 'id', 'id');
            $modelMedication = Model::createMultiple(MedicationDetail::classname());
            Model::loadMultiple($modelMedication, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelMedication, 'id', 'id')));
    
            // ajax validation
            /*if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMedDetail),
                    ActiveForm::validate($model)
                );
            }*/
    
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelMedication) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
    
                
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            MedicationDetail::deleteAll(['id' => $deletedIDs]);
                        }

                    
                        foreach ($modelMedication as $modelMedications) {
                            $modelMedications->med_id = $model->profile_id ;
                            if (! ($flag = $modelMedications->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Update success');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
    
        return $this->render('update', [
            'model' => $model,
            'modelMedication' => (empty($modelMedication)) ? [new MedicationDetail] : $modelMedication,
        ]);
    }
    }

    /**
     * Deletes an existing Medication model.
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
     * Finds the Medication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionPdf($id)
    {

        $searchModel        = new MedicationDetailSearch();
        $searchModelProfile        = new ProfileSearch();
        $searchModelAllergies        = new AllergiesSearch();
        $model = $this->findModel($id);
        $searchModelProfile->id = $id;
        $searchModelAllergies->profile_id = $model->profile_id;
        $searchModel->med_id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->setPagination(['pageSize' => 30]);
        $dataProvider->pagination = false; 
        $model = Medication::findOne(['id' => $id]);
        $modelProfile = Profile::findOne(['id' => $id]);
        $modelAllergies = Allergies::findOne(['profile_id' => $model->profile_id]);
        $modelMedication = MedicationDetail::findOne(['med_id' => $id]);

    
    
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_preview', [
            'model' => $model,
            'modelMedication' => $modelMedication,
            'modelProfile' => $modelProfile,
            'modelAllergies' => $modelAllergies,
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
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Report Case: '.$id],
            // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => 'Medication ' .$modelProfile->dk_code,
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Medication||Medication: ' .$modelProfile->dk_code],
                'SetFooter' => ['|Page {PAGENO}|'],
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

}
