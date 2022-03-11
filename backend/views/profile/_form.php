<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\VisaDetail;
use backend\models\Relative;
use backend\models\ProvinceDetail;
use backend\models\DistrictDetail;
use backend\models\SubdistrictDetail;
use backend\models\Medication;
use backend\models\Relationship;
use kartik\switchinput\SwitchInput;
use backend\models\CountryDetail;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">		
        <div class="col-sm-4">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>

		<div class="col-sm-4">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
        </div>

	    <div class="col-sm-4">
            <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>
        </div>

    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-4">
            <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
            ],
            'options'=>['class'=>'form-control']]);?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'nationality')->dropdownList(ArrayHelper::map(CountryDetail::find()
            ->where(['ct_status' => 0])->Orderby('ct_nameENG')->all(),
            'id','ct_nameENG'),
            ['prompt'=>'Nationality..']); ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'sex')->radioList($model->getItemSex()) ?>
        </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-3">
            <?= $form->field($model, 'house_no')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'village_no')->textInput() ?>
        </div>

        <div class="col-sm-3">
        <?= $form->field($model, 'alley')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'road')->textInput(['maxlength' => true]) ?>
        </div>



    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <?= $form->field($model, 'province')->TextInput() ?>
        </div>

        
        <div class="col-sm-4 col-md-4">
            <?= $form->field($model, 'district')->TextInput() ?>
        </div>

        <div class="col-sm-4 col-md-4">
            <?= $form->field($model, 'sub_district')->TextInput()  ?>
        </div>

       
    </div><!-- .row -->
    <div class="row">

        <div class="col-sm-2">
            <?= $form->field($model, 'post')->textInput() ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'country')->dropdownList(ArrayHelper::map(CountryDetail::find()
            ->where(['ct_status' => 0])->Orderby('ct_nameENG')->all(),
            'id','ct_nameENG'),
            ['prompt'=>'Country..']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => '999-999-9999',
                    'clientOptions'=>[
                'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
            ]
            ])?>
        </div>

        <div class="col-sm-4">
        <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::classname(), [

            'clientOptions'=>[
                'alias' =>  'email'
            ]
            ])?>
        </div>
        <div class="col-sm-1">
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
        ])?>

        </div>
    </div><!-- .row -->
    <div class="row">		
        <div class="col-sm-3">
            <?= $form->field($model, 'idcard')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'issued_at')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'date_issue')->widget(DatePicker::classname(), [
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
            ],
            'options'=>['class'=>'form-control']]);?>

        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'passport_exp')->widget(DatePicker::classname(), [
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
            ],
            'options'=>['class'=>'form-control']]);?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'usernames')->textInput(['readonly' => true]) ?>
        </div>
    </div><!-- .row -->

    <div class="row">

        <div class="col-sm-2">

            <?= $form->field($modelMedication, 'profile_id')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-sm-3">

            <?= $form->field($modelAdmit, 'profile_id')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-sm-3">

            <?= $form->field($modelPhysical, 'profile_id')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-sm-3">

            <?= $form->field($modelVisa, 'profile_id')->hiddenInput()->label(false); ?>
        </div>
        <div class="col-sm-2">

            <?= $form->field($modelHealth, 'profile_id')->hiddenInput()->label(false);?>
        </div>

        <div class="col-sm-4">

            <?= $form->field($modelAller, 'profile_id')->hiddenInput()->label(false); ?>
        </div>

    </div><!-- .row -->
	<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 5, // the maximum times, an element can be added (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelRelative[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id',
            'rela_name',
            'relaship_id',
            'rela_house_no',
            'rela_village_no',
            'rela_alley',
            'rela_road',
            'rela_sub_district',
            'rela_district',
            'rela_province',
            'rela_post',
            'rela_country',
            'rela_phone',
            'rela_email',
        ],
    ]); ?>
        <div class="container-items"><!-- widgetContainer -->
	            <?php foreach ($modelRelative as $i => $modelRelatives): ?>
	                <div class="item panel panel-default"><!-- widgetBody -->
	                    <div class="panel-heading">
	                        <h3 class="panel-title pull-left">Relatives</h3>
	                        <div class="pull-right">
	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelRelatives->isNewRecord) {
                                echo Html::activeHiddenInput($modelRelatives, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelRelatives, "[{$i}]rela_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-3">
                        <?= $form->field($modelRelatives, "[{$i}]relaship_id")->dropdownList(ArrayHelper::map(Relationship::find()
                            ->where(['relaship_status' => 0])->Orderby('relaship_name')->all(),
                            'id','relaship_name'),
                            ['prompt'=>'Select Relationship']); ?>
                        </div>

                            
                        <div class="col-sm-2">
                            <?= $form->field($modelRelatives, "[{$i}]rela_house_no")->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-2">
                            <?= $form->field($modelRelatives, "[{$i}]rela_village_no")->textInput() ?>
                        </div>

                        <div class="col-sm-1">
                            <?= $form->field($modelRelatives, "[{$i}]rela_alley")->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-2">
                            <?= $form->field($modelRelatives, "[{$i}]rela_road")->textInput(['maxlength' => true]) ?>
                        </div>

                    </div><!-- .row -->
                    <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($modelRelatives, "[{$i}]rela_province")->TextInput() ?>
                        </div>

                        
                        <div class="col-sm-4">
                        <?= $form->field($modelRelatives, "[{$i}]rela_district")->TextInput() ?>
                        </div>

                        <div class="col-sm-4">
                        <?= $form->field($modelRelatives, "[{$i}]rela_sub_district")->TextInput()  ?>
                        </div>
                    </div><!-- .row -->
                    <div class="row">

                    <div class="col-sm-3">
                    <?= $form->field($modelRelatives, "[{$i}]rela_post")->textInput() ?>
                    </div>

                    <div class="col-sm-2">
                    <?= $form->field($modelRelatives, "[{$i}]rela_country")->dropdownList(ArrayHelper::map(CountryDetail::find()
                        ->where(['ct_status' => 0])->Orderby('ct_nameENG')->all(),
                        'id','ct_nameENG'),
                        ['prompt'=>'Select Country']); ?>
                    </div>

                    <div class="col-sm-2">
                    <?= $form->field($modelRelatives, "[{$i}]rela_phone")->widget(\yii\widgets\MaskedInput::classname(), [
                        'mask' => '999-999-9999',
                                'clientOptions'=>[
                            'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
                        ]
                        ])?>
                    </div>

                    <div class="col-sm-3">
                    <?= $form->field($modelRelatives, "[{$i}]rela_email")->widget(\yii\widgets\MaskedInput::classname(), [

                        'clientOptions'=>[
                            'alias' =>  'email'
                        ]
                        ])?>
                    </div>


                </div>
                </div><!-- .row -->

                    </div>
	                </div>
	            <?php endforeach; ?>
	            </div>
    <?php DynamicFormWidget::end(); ?>
    
	        </div>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success'])?>

    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
