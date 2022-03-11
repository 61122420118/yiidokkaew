<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\MedicationDetailSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MedicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medication';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column){
                    $searchModel        = new MedicationDetailSearch();
                    $searchModel->med_id = $model->profile_id;
                    $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_detail', [
                        'searchModel'  => $searchModel,
                        'dataProvider' => $dataProvider
                    ]);
                },
            ],
            'profiles.dk_code',
            'profiles.fullname',
            'create',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'View',
                'buttonOptions'=>['class'=>'btn btn-info'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view}</div>'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Update',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {update}</div>'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Delete',
                'buttonOptions'=>['class'=>'btn btn-danger'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {delete} </div>'
            ],
        ],
    ]); ?>


</div>
