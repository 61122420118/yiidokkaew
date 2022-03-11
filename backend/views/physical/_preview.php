<?php
use yii\helpers\Html;
use backend\models\MedicationDetail;
use backend\models\Profile;
use backend\models\Doctor;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
$time = time();
//str_pad(,50,".",STR_PAD_BOTH);
Yii::$app->formatter->locale = 'th_TH';
?>
        <div style="text-align:center;font-size:18px;"><b>PHYSICAL EXAM</b></div>
        <div style="text-align:center;font-size:18px;"><b>(Medical personnel to complete)</b></div>
        <div> <strong >Height :  </strong><?= str_pad($model->height,10,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Weight :  </strong><?= str_pad($model->weight,10,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Temperature :  </strong><?= str_pad($model->temp,20,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Pulse :  </strong><?= str_pad($model->pulse,20,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Respiratory :  </strong><?= str_pad($model->respira,20,".",STR_PAD_BOTH); ?></div>
        <div><strong > Vision :  </strong><?= str_pad($model->vision,30,"."); ?> &emsp;&emsp;&emsp;&emsp;&emsp;
        <strong > Hearing :  </strong><?= str_pad($model->hearing,30,"."); ?>&emsp;&emsp;&emsp;&emsp;&emsp;
        <strong > Teeth :  </strong><?= str_pad($model->teeth,30,"."); ?></div>
        <div><strong > Cardiac :  </strong><?= str_pad($model->cardiac,160,"."); ?></div>
        <div><strong > Respiratory :  </strong><?= str_pad($model->respiratory,154,"."); ?></div>
        <div><strong > Gastrointestinal :  </strong><?= str_pad($model->gi,147,"."); ?></div>
        <div><strong > Genitourinary :  </strong><?= str_pad($model->gini_touri,151,"."); ?></div>
        <div><strong > Neurological/mentation :  </strong><?= str_pad($model->neurological,134,"."); ?></div>
        <div><strong > Neurovascular :  </strong><?= str_pad($model->neurovascular,150,"."); ?></div>
        <div><strong > Integument :  </strong><?= str_pad($model->integument,155,"."); ?></div>
        <div><strong > Assistive devices :  </strong><?= str_pad($model->assis_devices,145,"."); ?></div>
        <div><strong > Summary of physical exam :  </strong><?= str_pad($model->summary,1103,"."); ?></div>

        </div>
        <div class = "row">
        <div><strong>Examiner</strong><?=str_pad($modelProfile->fullname,80,".",STR_PAD_BOTH);?>
        <strong>Signature</strong><?=str_pad($model->getSigDoctors(),40,".",STR_PAD_BOTH);?>
        <strong>Date</strong><?=str_pad($model->exam_date,50,".",STR_PAD_BOTH);?>
        </div>
        </div>

