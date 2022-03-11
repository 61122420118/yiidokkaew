<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\VisaDetail;
use backend\models\VisaType;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Visa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visa-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 60, // the maximum times, an element can be added (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelVisaDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id',
            'visa_id',
            'visa_type',
			'visa_issue',
            'visa_exp'
        ],
    ]); ?>
        <div class="container-items"><!-- widgetContainer -->
	            <?php foreach ($modelVisaDetail as $i => $modelVisaDetails): ?>
	                <div class="item panel panel-default"><!-- widgetBody -->
	                    <div class="panel-heading">
	                        <h3 class="panel-title pull-left">Visa Detail</h3>
	                        <div class="pull-right">
	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelVisaDetails->isNewRecord) {
                                echo Html::activeHiddenInput($modelVisaDetails, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($modelVisaDetails, "[{$i}]visa_id")->hiddenInput()->label(false); ?>
                        <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($modelVisaDetails, "[{$i}]visa_type")->dropdownList(ArrayHelper::map(VisaType::find()
                                ->where(['visa_status' => 0])->Orderby('id')->all(),
                                'id','visa_name'),
                                ['prompt'=>'Select Type..']);?>
                            </div>
                            <div class="col-sm-2">
                            <?= $form->field($modelVisaDetails, "[{$i}]visa_issue")->widget(\yii\widgets\MaskedInput::classname(), [

                                'clientOptions'=>[
                                    'alias' =>  ['yyyy/mm/dd']
                                ]
                                ])?>
                            </div>


							<div class="col-sm-2">
                            <?= $form->field($modelVisaDetails, "[{$i}]visa_exp")->widget(\yii\widgets\MaskedInput::classname(), [

                                'clientOptions'=>[
                                    'alias' =>  ['yyyy/mm/dd']
                                ]
                                ]) ?>
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
