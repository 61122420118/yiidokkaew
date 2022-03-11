<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Relationship */

$this->title = 'Update Relationship: ' . $model->relaship_name;
$this->params['breadcrumbs'][] = ['label' => 'Relationship', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->relaship_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relationship-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
