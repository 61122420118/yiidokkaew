<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AllergiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Allergies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allergies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Allergies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'profile_id',
            'aller_name',
            'aller_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
