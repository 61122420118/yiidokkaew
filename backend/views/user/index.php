<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',

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
