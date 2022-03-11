<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = 'Update Profile: ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelVisa'  => $modelVisa,
        'modelRelative'=>$modelRelative,
        'modelHealth'=>$modelHealth,
        'modelAller'=>$modelAller,
        'modelPhysical'=>$modelPhysical,
        'modelAdmit'=>$modelAdmit,
        'modelMedication'=>$modelMedication,


    ]) ?>

</div>
