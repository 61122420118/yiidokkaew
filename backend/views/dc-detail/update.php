<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DcDetail */

$this->title = 'Update Dc Detail: ' . $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'Dc Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->detail, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dc-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
