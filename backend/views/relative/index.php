<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Relative;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RelativeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relative';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relative-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'relatives.dk_code',
            'relatives.fullname',
            'rela_name',
            'relations.relaship_name',
            'rela_phone',
            //'village_no',
            //'alley',
            //'road',
            //'sub_district',
            //'district',
            //'province',
            //'post',
            //'country',
            //'house_no',
            //'rela_email:email',
            //'rela_status',
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
