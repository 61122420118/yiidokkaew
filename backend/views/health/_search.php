<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HealthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="health-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'symptom') ?>

    <?= $form->field($model, 'ls_doc') ?>

    <?= $form->field($model, 'ls_where') ?>

    <?php // echo $form->field($model, 'sig_health') ?>

    <?php // echo $form->field($model, 'date_assessed') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
