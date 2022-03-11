<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model backend\models\Doctor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sig_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sig_status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->sig_status // !!!
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
