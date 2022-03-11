<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use backend\models\MedicationDetail;
use backend\models\MedicationDetailSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Medication */

$this->title = $model->profiles->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Medications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Print', ['pdf', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profiles.dk_code',
            'profiles.fullname',
            'create',
        ],
    ]) ?>
            <ul>
        <?= $this->render('_detail_view', [
                'dataProvider' => $dataProvider,
            ]) ?>

</div>
