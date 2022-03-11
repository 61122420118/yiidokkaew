<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use backend\models\CountryDetail;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */
$i = 1;
$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Print', ['pdf', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Admit', ['/admit/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Physical', ['/physical/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Medication', ['/medication/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'dk_code',
            'fullName',
            'birth',
            [
                'format'=>'html',
                'label' => 'Age',
                'value' => $model->getAge(),
            ],
            'sextext',
            'nationalitys.ct_nameENG',
            'address',
            'phone',
            'email:email',
            'card',
            'create',
            'statustext',
            'users.username',


        ],
    ]) ?>

<?= $this->render('_detail_view', [
                'dataProvider' => $dataProvider,
            ]) ?>



</div>

<div style="font-size:25px; background-color: rgba(245, 149, 178, 0.6); color:black;"><b>Visa</b></div>

<table class="table table-striped table-bordered"  width="100%" border="5px" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color:rgba(245, 149, 178, 0.6);">
                <td><b>Name</b></td>
                <td><b>Issue</b></td>
                <td><b>Expire</b></td>


            </tr>
        </thead>

        <?php


        foreach ( $model->getVisadetail() as $ss) {

            ?>
        <tbody>
        <tr style="background-color: rgba(245, 149, 178, 0.4);">

        <td><?= $ss['visa_name'] ?></td>
        <td><?= $ss['visa_issue'] ?></td>
        <td><?= $ss['visa_exp']?> </td>

            </tbody>
        <?php }
        ?>

        </table>  

        <div style="font-size:25px; background-color: rgba(255, 179, 179, 0.6);"><b>Medication</b></div>

<table class="table table-striped table-bordered"  width="100%" border="5px" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color: rgba(255, 179, 179, 0.6);">
                <td><b>Date</b></td>
                <td><b>Name</b></td>
                <td><b>Dose</b></td>
                <td><b>Route</b></td>
                <td><b>Frequency</b></td>
                <td><b>Purpose</b></td>
                <td><b>Time</b></td>
                <td><b>Duration</b></td>


            </tr>
        </thead>

        <?php


        foreach ( $model->getMedicationDetail() as $med) {

            ?>
        <tbody>
        <tr style="background-color: rgba(255, 179, 179, 0.4);">
        <td><?= $med['date'] ?></td>
        <td><?= $med['med_name'] ?></td>
        <td><?= $med['med_dose'] ?></td>
        <td><?= $med['routeName']?> </td>
        <td><?= $med['med_frequency'] ?></td>
        <td><?= $med['med_purpose'] ?></td>
        <td><?= $med['med_time'] ?></td>
        <td><?= $med['dura_name'] ?></td>

            </tbody>
        <?php }
        ?>

        </table>  
        rgba(255, 241, 186, 0.5)
        <div style="font-size:25px; background-color: rgba(255, 241, 186, 0.6);"><b>Physical</b></div>

<table class="table table-striped table-bordered"  width="100%" border="5px" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color: rgba(255, 241, 186, 0.6);">
                <td><b>Exam date</b></td>
                <td><b>Body</b></td>
                <td><b>TPR</b></td>
                <td><b>Info</b></td>
                <td><b>Doctor</b></td>



            </tr>
        </thead>

        <?php


        foreach ( $model->getPhysic() as $phy) {

            ?>
        <tbody>
        <tr style="background-color: rgba(255, 241, 186, 0.4);">
        <td><?= $phy['exam_date'] ?></td>
        <td><?= $phy['data'] ?></td>
        <td><?= $phy['temperate'] ?></td>
        <td><?= $phy['visions'] ?></td>
        <td><?= $phy['sigDoctors'] ?></td>


            </tbody>
        <?php }
        ?>

        </table> 

        <div style="font-size:25px; background-color: rgba(190, 227, 237, 0.6);"><b>Health</b></div>

<table class="table table-striped table-bordered" width="100%" border="5px" cellpadding="0" cellspacing="0">
        <thead>
            <tr  style="background-color: rgba(190, 227, 237, 0.6);">
                <td><b>Symptom</b></td>
                <td><b>Last seen Doctor</b></td>
                <td><b>Doctor</b></td>




            </tr>
        </thead>

        <?php


        foreach ( $model->getHeal() as $heal) {

            ?>
        <tbody>
        <tr style="background-color: rgba(190, 227, 237, 0.4);">
        <td><?= $heal['symptom'] ?></td>
        <td><?= $heal['lS'] ?></td>
        <td><?= $heal['doc'] ?></td>



            </tbody>
        <?php }
        ?>

        </table> 

        <table class="table table-striped table-bordered"  width="100%" border="5px" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color: rgba(175, 173, 222, 0.6);">
                <td><b>Admit date</b></td>
                <td><b>Discharge date</b></td>
                <td><b>Discharge detail</b></td>
                <td><b>Remark</b></td>




            </tr>
        </thead>

        <?php


        foreach ( $model->getAdmitview() as $admit) {

            ?>
        <tbody>
        <tr style="background-color: rgba(175, 173, 222, 0.4);">
        <td><?= $admit['admit_date'] ?></td>
        <td><?= $admit['dc_date'] ?></td>
        <td><?= $admit['detail'] ?></td>
        <td><?= $admit['ad_remark'] ?></td>



            </tbody>
        <?php }
        ?>

        </table> 

