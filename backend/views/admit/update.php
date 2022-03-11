<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admit */

$this->title = 'Update Admit: ' . $modelProfile->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Admits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelProfile->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelProfile' => $modelProfile
    ]) ?>

</div>
