<?php
use yii\helpers\Html;
use backend\models\MedicationDetail;
use backend\models\Profile;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
$time = time();
//str_pad(,50,".",STR_PAD_BOTH);
Yii::$app->formatter->locale = 'th_TH';
?>
         <div style="text-align:center;font-size:14px;"><b>McKean Senior Center</b></div>
         <div style="text-align:center;font-size:18px;"><b>Dok Kaew Gardens</b></div>
        <div style="text-align:center;font-size:14px;"><b>MEDICATION SHEET (ใบบันทึกรายการยา)</b></div>
        <div> <strong >Fullname :  </strong><?= str_pad($modelProfile->fullname,100,".",STR_PAD_BOTH); ?></div>
        <div> <strong >Allergies :  </strong><?= str_pad($modelAllergies->aller_name,50,".",STR_PAD_BOTH); ?> 
        <strong > Birth date :  </strong><?= str_pad($modelProfile->birth_date,50,".",STR_PAD_BOTH); ?></div>

        <table class="table_bordered" width="100%" border="0" cellspacing="0">
            <thead>
                   <tr>
                    <td><b>ลำดับ</b></td>
                    <td><b>Date</b></td>
                    <td><b>Name</b></td>
                    <td><b>Dose</b></td>
                    <td><b>Route</b></td>
                    <td><b>Frequency</b></td>
                    <td><b>Purpose of medication</b></td>
                    <td><b>Time</b></td>
                    <td><b>Duration</b></td>

                </tr>
            </thead>
            
            <?php
            
            $i = 1;
            foreach ( $model->getRfp() as $each) {

                ?>
            <tbody>
              <tr>
              <td><?= $i ?></td>
              <td><?= $each['date'] ?></td>
              <td><?= $each['med_name'] ?></td>
              <td><?= $each['med_dose']?> </td>
              <td><?= $each['med_route']?> </td>
              <td><?= $each['med_frequency']?> </td>
              <td><?= $each['med_purpose']?> </td>
                <td> <?= $each['med_time']?> </td>
                <td> <?= $each['dura_name']?> </td>
                <?=$i++?>
                </tbody>
        <?php }
        ?>

    </table>  