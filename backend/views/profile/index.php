<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\switchinput\SwitchInput;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dk_code',
            'fullName',
            'statustext',
            //'birth_date',
            //'nationality',
            //'age',
            //'house_no',
            //'village_no',
            //'alley',
            //'road',
            //'sub_district',
            //'district',
            //'province',
            //'post',
            //'country',
            //'phone',
            //'email:email',
            //'idcard',
            //'issued_at',
            //'date_issue',
            //'passport_exp',
            //'user',
            //'create_at',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dk_code',
            'idcard',
            'fullName',
            [
                'attribute' => 'birth_date',
                'label' => 'Age', //Only user's point of view it's age but from programmers side it's DOB
                'value' => function ($model, $key, $index, $column) { //Make use of the construct
                    $dateOfBirth = $model->birth_date;
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    return $diff->format('%y');
                },
                'format' => 'raw'
            ],
            //'birth_date',
            //'nationality',
            //'age',
            //'house_no',
            //'village_no',
            //'alley',
            //'road',
            //'sub_district',
            //'district',
            //'province',
            //'post',
            //'country',
            //'phone',
            //'email:email',
            //'idcard',
            //'issued_at',
            //'date_issue',
            //'passport_exp',
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
