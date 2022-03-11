<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SymptomDetail */

$this->title = 'Create Symptom Detail';
$this->params['breadcrumbs'][] = ['label' => 'Symptom Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symptom-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
