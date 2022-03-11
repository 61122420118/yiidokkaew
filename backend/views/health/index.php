<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HealthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Health';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="health-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    'profiles.dk_code',
                    'profiles.fullname',
                    'symptom:ntext',
                    'lS',
                    'doc',
                    'users.username',
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
            'doc',
            'symptom:ntext',
            //'sig_health',
            //'date_assessed',
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
