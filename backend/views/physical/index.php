<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhysicalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Physical';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physical-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    'profiles.dk_code',
                    'profiles.fullname',
                    'data',
                    'temperate',
                    'vision',
                    'hearing',
                    'teeth',
                    'cardiac',
                    'respiratory',
                    'gi',
                    'gini_touri',
                    'neurological',
                    'neurovascular',
                    'integument',
                    'assis_devices',
                    'summary:ntext',
                    'doc',
                    'create',
        
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'profiles.dk_code',
            'profiles.fullname',
            'data',
            'doc',
            //'respira',
            //'vision',
            //'hearing',
            //'teeth',
            //'cardiac',
            //'respiratory',
            //'gi',
            //'gini_touri',
            //'neurological',
            //'neurovascular',
            //'integument',
            //'assis_devices',
            //'summary:ntext',
            //'doctor',
            //'exam_date',
            //'user',
            //'create_at',
            //'update_at',

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
