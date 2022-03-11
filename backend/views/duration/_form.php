<?php

use yii\helpers\Html;
use kartik\switchinput\SwitchInput;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Duration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dura_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dura_status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->dura_status // !!!
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
