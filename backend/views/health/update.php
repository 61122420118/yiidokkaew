<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Health */

$this->title = 'Update Health: ' . $model->profiles->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Health', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profiles->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="health-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
