<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SymptomDetail;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\SymptomDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="symptom-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'symp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'symp_status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->symp_status // !!!
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
