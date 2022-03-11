<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Relative */

$this->title = 'Update Relative: ' . $model->rela_name;
$this->params['breadcrumbs'][] = ['label' => 'Relatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rela_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relative-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'district'=> $district,
        'subdistrict' => $subdistrict,
    ]) ?>

</div>
