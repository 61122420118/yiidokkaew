<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$url = Yii::getAlias("@web") . '/img/dokkaew.jpg';
$this->title = 'Dokkaew Garden';
?>
<div class="site-login" style="font-size:27px;background-color: rgba(255, 223, 211, 0.6); ; color:yellow;">
    <h1><?= Html::encode($this->title) ?></h1>
    <style>
body {
  background-image: url('<?php echo $url ?>');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
   
    <p >Fill username and password :</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>