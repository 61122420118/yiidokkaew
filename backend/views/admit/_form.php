<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\DcDetail;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Admit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admit-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">		
      <div class="col-sm-4">
          <?= $form->field($model, 'admit_date')->textInput(['readonly' => true])?>
      </div>

      <div class="col-sm-4">
          <?= $form->field($model, 'dc_date')->widget(DatePicker::classname(), [
          'language' => 'th',
          'dateFormat' => 'yyyy-MM-dd',
          'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
          ],
          'options'=>['class'=>'form-control']]);?>
      </div>

      <div class="col-sm-4">
          <?= $form->field($model, 'dc_detail')->dropdownList(ArrayHelper::map(DcDetail::find()
            ->where(['status' => 0])->Orderby('detail')->all(),
            'id','detail'),
            ['prompt'=>'Detail..']); ?>
      </div>


    <div class="row">		
        <div class="col-sm-12">
        <?= $form->field($model, 'ad_remark')->textarea(['rows' => 6]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
