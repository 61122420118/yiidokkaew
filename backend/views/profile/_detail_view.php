<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

    <h3><b>Relative</b></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

       
       'columns' => [


        'rela_name',
        'relations.relaship_name',
        'address1',
        'rela_phone',
        'rela_email:email',
        'status',

    ],
]); ?>
