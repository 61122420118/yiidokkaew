<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Duration */

$this->title = 'Update Duration: ' . $model->dura_name;
$this->params['breadcrumbs'][] = ['label' => 'Duration', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dura_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="duration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
