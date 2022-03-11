<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายละเอียดการขาย';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,


        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'ลำดับ',],
 

            //'id',
            //'sale_id',
            'visaTypes.visa_name',
            'dateVisa',



        ],
    ]);
 
   
 ?>

</div>