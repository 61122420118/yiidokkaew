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

        'visaTypes.visa_name',
        'visa_issue',
        'visa_exp',

    ],
]); ?>