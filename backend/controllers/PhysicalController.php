<?php

namespace backend\controllers;

use Yii;
use backend\models\Physical;
use backend\models\PhysicalSearch;
use backend\models\Profile;
use backend\models\ProfileSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Doctor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * PhysicalController implements the CRUD actions for Physical model.
 */
class PhysicalController extends Controller
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
     * Lists all Physical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhysicalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Physical model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Physical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Physical();
        $searchModelProfile        = new ProfileSearch();
        $modelProfile = Profile::findOne(['id' => $id]);
        $model->create_at = date('Y-m-d H:i:s');
        $model->doctor = 1;
        $model->user = Yii::$app->user->identity->id;
        $model->usernames = Yii::$app->user->identity->username;
        $model->examiner = $modelProfile->fullname;
        $model->examine = $modelProfile->fullname;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelProfile' => $modelProfile
        ]);
    }

    /**
     * Updates an existing Physical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProfile = $model->profiles;

        $model->user = Yii::$app->user->identity->id;
        $model->usernames = Yii::$app->user->identity->username;
        $model->examiner = $modelProfile->fullname;
        $model->examine = $modelProfile->fullname;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Save success');
            return Yii::$app->response->redirect(Url::to(['/health/update', 'id' => $model->id],[ 'class' => 'btn btn-success']));;
        }

        return $this->render('update', [
            'model' => $model,
            'modelProfile' => $modelProfile
        ]);
    }

    /**
     * Deletes an existing Physical model.
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
     * Finds the Physical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Physical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Physical::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionPdf($id)
    {

        $searchModel        = new PhysicalSearch();
        $searchModelProfile        = new ProfileSearch();
        $model = $this->findModel($id);
        $searchModelProfile->id = $id;
        $searchModel->id = $id;
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->setPagination(['pageSize' => 30]);
        $dataProvider->pagination = false; 
        $model = Physical::findOne(['id' => $id]);
        $modelProfile = Profile::findOne(['id' => $id]);


    
    
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_preview', [
            'model' => $model,
            'modelProfile' => $modelProfile,
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
                'SetTitle' => 'Physical Exam ' .$modelProfile->dk_code,
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Physical Exam||Physical Exam : ' .$modelProfile->dk_code],
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
