<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

       
       'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'date',
        'med_name',
        'med_dose',
        'routes.route_name',
        'med_frequency',
        'med_purpose',
        'med_time',
        'medDura.dura_name',

    ],
]); ?>