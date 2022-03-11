<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Health */

$this->title = 'Create Health';
$this->params['breadcrumbs'][] = ['label' => 'Healths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="health-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
