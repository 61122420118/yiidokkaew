<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Physical */

$this->title = 'Create Physical';
$this->params['breadcrumbs'][] = ['label' => 'Physicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelProfile' => $modelProfile
    ]) ?>

</div>
