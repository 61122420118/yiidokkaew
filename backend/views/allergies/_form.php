<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Allergies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="allergies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'aller_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aller_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
