<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DcDetail */

$this->title = 'Create Dc Detail';
$this->params['breadcrumbs'][] = ['label' => 'Dc Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dc-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
