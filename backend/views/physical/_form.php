<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Doctor;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Physical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="physical-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">		
    <?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>
        <div class="col-sm-3">
            <?= $form->field($model, 'height')->textInput() ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'weight')->textInput() ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'temp')->textInput() ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'pulse')->textInput() ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'respira')->textInput() ?>
        </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-4">
            <?= $form->field($model, 'vision')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'hearing')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'teeth')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-6">
    <?= $form->field($model, 'cardiac')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
    <?= $form->field($model, 'respiratory')->textInput(['maxlength' => true]) ?>
    </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-6">
    <?= $form->field($model, 'gi')->textInput(['maxlength' => true]) ?>
            </div>

    <div class="col-sm-6">
    <?= $form->field($model, 'gini_touri')->textInput(['maxlength' => true]) ?>
    </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-6">
    <?= $form->field($model, 'neurological')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">

    <?= $form->field($model, 'neurovascular')->textInput(['maxlength' => true]) ?>
    </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-6">
    <?= $form->field($model, 'integument')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">

    <?= $form->field($model, 'assis_devices')->textInput(['maxlength' => true]) ?>
    </div>
    </div><!-- .row -->
    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
    <div class="row">	
        <div class="col-sm-3">
            <?= $form->field($model, 'examine')->textInput(['readonly' => true]) ?>
        </div>	
        <div class="col-sm-3">

            <?= $form->field($model, 'doctor')->dropdownList(ArrayHelper::map(Doctor::find()
            ->where(['sig_status' => 0])->Orderby('sig_name')->all(),
            'id','sig_name'),
            ['prompt'=>'Doctor..']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'exam_date')->widget(DatePicker::classname(), [
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions'=>[
                'changeMonth'=>true,
                'changeYear'=>true,
                ],
                'options'=>['class'=>'form-control']]);?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'usernames')->textInput(['readonly' => true]) ?>
        </div>
    </div><!-- .row -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
