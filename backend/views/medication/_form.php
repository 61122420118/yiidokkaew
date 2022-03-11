<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\MedicationDetail;
use backend\models\Duration;
use backend\models\MedTime;
use backend\models\Route;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Medication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medication-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


    <?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>

	<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 200, // the maximum times, an element can be added (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelMedication[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id',
            'med_name',
			'date',
            'med_dose',
			'med_route',
			'med_frequency',
			'med_purpose',
            'med_time'
        ],
    ]); ?>
        <div class="container-items"><!-- widgetContainer -->
	            <?php foreach ($modelMedication as $i => $modelMedications): ?>
	                <div class="item panel panel-default"><!-- widgetBody -->
	                    <div class="panel-heading">
	                        <h3 class="panel-title pull-left">Medication</h3>
	                        <div class="pull-right">
	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelMedications->isNewRecord) {
                                echo Html::activeHiddenInput($modelMedications, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($modelMedications, "[{$i}]med_name")->TextInput()?>
                            </div>
                            <div class="col-sm-2">
                            <?= $form->field($modelMedications, "[{$i}]date")->widget(\yii\widgets\MaskedInput::classname(), [

                                'clientOptions'=>[
                                    'alias' =>  ['yyyy/mm/dd']
                                ]
                                ])?>
                            </div>
							
							<div class="col-sm-2">
                                <?= $form->field($modelMedications, "[{$i}]med_dose")->textInput(['maxlength' => true]) ?>
                            </div>
							<div class="col-sm-2">
                                <?= $form->field($modelMedications, "[{$i}]med_route")->dropdownList(
										ArrayHelper::map(Route::find()
										->where(['route_status' => 0])->all(),
										'id',
										'route_name'),
										[
											'prompt'=>'Select_route...'
							]); ?>
                            </div>
							<div class="col-sm-2">
                                <?= $form->field($modelMedications, "[{$i}]med_frequency")->textInput(['maxlength' => true]) ?>
                            </div>
							<div class="col-sm-2">
                                <?= $form->field($modelMedications, "[{$i}]med_purpose")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                        <div class="col-sm-2">
                        <?= $form->field($modelMedications, "[{$i}]med_time")->checkboxlist(ArrayHelper::map(MedTime::find()->all(),'medtime_name','medtime_name')) ?>


                        </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelMedications, "[{$i}]med_duration")->dropdownList(
										ArrayHelper::map(Duration::find()
										->where(['dura_status' => 0])->all(),
										'id',
										'dura_name'),
										[
											'prompt'=>'Select Duration...'
							]);?>
                            </div>
                            
                            </div><!-- .row -->
                            

                    </div>
	                </div>
	            <?php endforeach; ?>
	            </div>
    <?php DynamicFormWidget::end(); ?>
	        </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
