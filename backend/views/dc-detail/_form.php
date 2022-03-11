<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\DcDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dc-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->status // !!!
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
