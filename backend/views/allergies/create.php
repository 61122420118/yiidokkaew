<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Allergies */

$this->title = 'Create Allergies';
$this->params['breadcrumbs'][] = ['label' => 'Allergies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allergies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
