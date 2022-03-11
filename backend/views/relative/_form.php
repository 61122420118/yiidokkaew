<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ProvinceDetail;
use backend\models\DistrictDetail;
use backend\models\SubdistrictDetail;
use backend\models\CountryDetail;
use backend\models\Relationship;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Relative */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relative-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
    <div class="col-sm-3">
    <?= $form->field($model, 'rela_name')->textInput(['maxlength' => true]) ?>
    </div>

        
<div class="col-sm-3">
    <?= $form->field($model, 'relaship_id')->dropdownList(ArrayHelper::map(Relationship::find()
		->where(['relaship_status' => 0])->Orderby('relaship_name')->all(),
		'id','relaship_name'),
		['prompt'=>'Select Relationship']); ?>
    </div>

        
<div class="col-sm-1">
    <?= $form->field($model, 'rela_house_no')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-1">
    <?= $form->field($model, 'rela_village_no')->textInput() ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_alley')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_road')->textInput(['maxlength' => true]) ?>
    </div>

</div><!-- .row -->






    <div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'rela_province')->TextInput(); ?>
        </div>

        
        <div class="col-sm-4">
        <?= $form->field($model, 'rela_district')->TextInput(); ?>
        </div>

        <div class="col-sm-4">
        <?= $form->field($model, 'rela_sub_district')->TextInput();  ?>
        </div>

       
    </div><!-- .row -->

    
<div class="row">
    <div class="col-sm-3">
    <?= $form->field($model, 'rela_post')->textInput() ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_country')->dropdownList(ArrayHelper::map(CountryDetail::find()
		->where(['ct_status' => 0])->Orderby('ct_nameENG')->all(),
		'id','ct_nameENG'),
		['prompt'=>'Select Country']); ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_phone')->widget(\yii\widgets\MaskedInput::classname(), [
        'mask' => '999-999-9999',
            'clientOptions'=>[
            'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
        ]
        ]) ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_email')->widget(\yii\widgets\MaskedInput::classname(), [

        'clientOptions'=>[
            'alias' =>  'email'
        ]
        ]) ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'rela_status')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'size' => 'mini',
                'offColor' => 'success',
                'onColor' => 'danger',
                'onText' => 'No Active',
                'offText' => 'Active',
            ],
            'options' => [
                'id' => $model->rela_status // !!!
            ],
        ]); ?>
    </div>

</div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
