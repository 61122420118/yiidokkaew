<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Medication */

$this->title = 'Update Medication: ' . $model->profiles->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Medications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profiles->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelMedication' => $modelMedication,
    ]) ?>

</div>
