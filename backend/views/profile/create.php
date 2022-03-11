<?php

use yii\helpers\Html;
use backend\models\Profile;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = 'Create Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">

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
