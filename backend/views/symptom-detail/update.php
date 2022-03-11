<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SymptomDetail */

$this->title = 'Update Symptom Detail: ' . $model->symp_name;
$this->params['breadcrumbs'][] = ['label' => 'Symptom Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->symp_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="symptom-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
