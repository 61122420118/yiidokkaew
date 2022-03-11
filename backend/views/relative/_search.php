<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RelativeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relative-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'rela_name') ?>

    <?= $form->field($model, 'relaship_id') ?>

    <?= $form->field($model, 'rela_house_no') ?>

    <?php // echo $form->field($model, 'village_no') ?>

    <?php // echo $form->field($model, 'alley') ?>

    <?php // echo $form->field($model, 'road') ?>

    <?php // echo $form->field($model, 'sub_district') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'post') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'rela_phone') ?>

    <?php // echo $form->field($model, 'rela_email') ?>

    <?php // echo $form->field($model, 'rela_status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
