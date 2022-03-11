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
        <div style="text-align:center;font-size:14px;"><b>McKean Seior Center</b></div>
        <div style="text-align:center;font-size:18px;"><b>Dok Kaew Gardens</b></div>
        <div style="text-align:center;font-size:18px;"><b>HEALTH ASSESSMENT</b></div>
        <div style="text-align:center;font-size:14px;"><b>แบบประเมินสุขภาพ</b></div>
        <div> <strong >Name :  </strong><?= str_pad($modelProfile->fullname,110,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Date of Birth :  </strong><?= str_pad($modelProfile->birth_date,50,".",STR_PAD_BOTH); ?></div>
            <div><strong > Symptom :  </strong><?= str_pad($model->symptom,142,".",STR_PAD_BOTH); ?></div>
        <div><strong > Last seen date:  </strong><?= str_pad($model->ls_doc,30,".",STR_PAD_BOTH); ?>&emsp;
        <strong > Last seen where :  </strong><?= str_pad($model->ls_where,85,".",STR_PAD_BOTH); ?>
        </div>
        <div><strong > Signature :  </strong><?= str_pad($model->getSigDoctors(),50,".",STR_PAD_BOTH); ?>&ensp;&ensp;
         <strong > Date Assessment :  </strong><?= str_pad($model->date_assessed,80,".",STR_PAD_BOTH); ?></div>