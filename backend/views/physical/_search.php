<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhysicalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="physical-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'height') ?>

    <?= $form->field($model, 'weight') ?>

    <?= $form->field($model, 'temp') ?>

    <?php // echo $form->field($model, 'pulse') ?>

    <?php // echo $form->field($model, 'respira') ?>

    <?php // echo $form->field($model, 'vision') ?>

    <?php // echo $form->field($model, 'hearing') ?>

    <?php // echo $form->field($model, 'teeth') ?>

    <?php // echo $form->field($model, 'cardiac') ?>

    <?php // echo $form->field($model, 'respiratory') ?>

    <?php // echo $form->field($model, 'gi') ?>

    <?php // echo $form->field($model, 'gini_touri') ?>

    <?php // echo $form->field($model, 'neurological') ?>

    <?php // echo $form->field($model, 'neurovascular') ?>

    <?php // echo $form->field($model, 'integument') ?>

    <?php // echo $form->field($model, 'assis_devices') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'doctor') ?>

    <?php // echo $form->field($model, 'exam_date') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
