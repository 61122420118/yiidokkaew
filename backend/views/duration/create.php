<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Duration */

$this->title = 'Create Duration';
$this->params['breadcrumbs'][] = ['label' => 'Durations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
