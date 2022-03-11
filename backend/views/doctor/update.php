<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Doctor */

$this->title = 'Update Doctor: ' . $model->sig_name;
$this->params['breadcrumbs'][] = ['label' => 'Doctor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sig_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
