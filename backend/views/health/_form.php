<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SymptomDetail;
use backend\models\Health;
use backend\models\Doctor;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Health */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="health-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?php
    echo Select2::widget([
        'model' => $model,
        'name' => 'symptom',
        'attribute' => 'symptom',
        'data' => ArrayHelper::map(SymptomDetail::find()->where(['symp_status' => 0 ])->orderBy('id')->all(),'symp_name','symp_name'),  //['1'=>'1','2'=>2],
        'options' => [
            'placeholder' => 'Select symptom ...',
            'multiple' => true
    ],
    ]);
    ?>


    <div class="row">		
      <div class="col-sm-4">
          <?= $form->field($model, 'ls_doc')->widget(DatePicker::classname(), [
          'language' => 'th',
          'dateFormat' => 'yyyy-MM-dd',
          'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
          ],
          'options'=>['class'=>'form-control']]);?>
      </div>
      <div class="col-sm-4">
          <?= $form->field($model, 'ls_where')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-sm-4">
          <?= $form->field($model, 'sig_health')->dropdownList(ArrayHelper::map(Doctor::find()
            ->where(['sig_status' => 0])->Orderby('sig_name')->all(),
            'id','sig_name'),
            ['prompt'=>'Doctor..']); ?>
      </div>
    </div>

    <div class="row">		
      <div class="col-sm-4">
          <?= $form->field($model, 'date_assessed')->widget(DatePicker::classname(), [
          'language' => 'th',
          'dateFormat' => 'yyyy-MM-dd',
          'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
          ],
          'options'=>['class'=>'form-control']]);?>
      </div>

      <div class="col-sm-4">
          <?= $form->field($model, 'usernames')->textInput(['readonly' => true]) ?>
      </div>
  </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
