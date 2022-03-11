<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medication Detail';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,


        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'ลำดับ',],
 

            //'id',
            //'sale_id',
            'date',
            'med_name',
            'med_dose',
            'routes.route_name',
            'med_frequency',
            'med_purpose',
            'med_time',
            'med_duration',



        ],
    ]);
 
   
 ?>

</div>