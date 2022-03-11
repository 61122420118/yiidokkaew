<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dk_code') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'middlename') ?>

    <?php // echo $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'house_no') ?>

    <?php // echo $form->field($model, 'village_no') ?>

    <?php // echo $form->field($model, 'alley') ?>

    <?php // echo $form->field($model, 'road') ?>

    <?php // echo $form->field($model, 'sub_district') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'post') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'idcard') ?>

    <?php // echo $form->field($model, 'issued_at') ?>

    <?php // echo $form->field($model, 'date_issue') ?>

    <?php // echo $form->field($model, 'passport_exp') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
