<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Physical */

$this->title = $model->profiles->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Physical', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="physical-view">

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
            'data',
            'temperate',
            'vision',
            'hearing',
            'teeth',
            'cardiac',
            'respiratory',
            'gi',
            'gini_touri',
            'neurological',
            'neurovascular',
            'integument',
            'assis_devices',
            'summary:ntext',
            'doc',
            'create',
        ],
    ]) ?>

</div>
