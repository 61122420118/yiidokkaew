<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Visa */

$this->title = 'Update Visa: ' . $model->profiles->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Visa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profiles->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelVisaDetail' => $modelVisaDetail,
    ]) ?>

</div>
