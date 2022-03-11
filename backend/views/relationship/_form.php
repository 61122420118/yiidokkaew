<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Relationship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relationship-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'relaship_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relaship_status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->relaship_status // !!!
            ],
        ])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
