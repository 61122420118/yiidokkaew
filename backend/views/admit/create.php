<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admit */

$this->title = 'Create Admit';
$this->params['breadcrumbs'][] = ['label' => 'Admits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelProfile' => $modelProfile
    ]) ?>

</div>
