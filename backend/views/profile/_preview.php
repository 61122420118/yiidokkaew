<?php
use yii\helpers\Html;
use backend\models\Relative;
use backend\models\VisaDetail;
use backend\models\CountryDetail;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
$time = time();

//str_pad(,50,".",STR_PAD_BOTH);
Yii::$app->formatter->locale = 'th_TH';
?> 

        <div style="text-align:center;font-size:18px;"><b>สถาบันผู้สูงอายุแมคเคน/McKean Senior Center</b></div>
        <div style="text-align:center;font-size:18px;"><b>บ้านดอกแก้ว/Dok Kaew Gardens</b></div>
        <div style="text-align:center;font-size:18px;"><b>Admission Agreement (Short term)</b></div>
        <div style="text-align:center;font-size:18px;"><b>หนังสือสัญญา (ระยะสั้น)</b></div>
        <div style="text-align:center;font-size:14px;"><b>For those seeking residency at Dok Kaew Gardens,McKean Senior Center</b></div>
        <div style="text-align:center;font-size:14px;"><b>Agreement made at Dok Kaew Gardens,McKean Senior Center</b></div>
        <div style="text-align:center;font-size:14px;"><b>สำหรับการเข้าพักอาศัยในศูนย์ดูแลผู้สูงวัยบ้านดอกแก้ว สถาบันผู้สูงอายุแมคเคน</b></div>
        <div style="text-align:center;font-size:14px;"><b>ทำที่ศูนย์ดูแลผู้สูงวัยบ้านดอกแก้ว สถาบันผู้สูงอายุแมคเคน</b></div>
        <div > <strong >Lastname :  </strong><?= str_pad($model->lastname,50,".",STR_PAD_BOTH); ?> 
              <strong>Firstname :</strong>  <?= str_pad($model->firstname,50,".",STR_PAD_BOTH); ?> 
              <strong>Middlename : </strong> <?= str_pad($model->middlename,50,".",STR_PAD_BOTH); ?>
        </div>
        <div> <strong> Brith Date : </strong> <?= str_pad($model->birth_date,30,".",STR_PAD_BOTH); ?> 
              <strong>Age : </strong> <?= str_pad($model->getAge(),15,".",STR_PAD_BOTH); ?>
              <strong>Sex : </strong> <?= str_pad($model->sextext,15,".",STR_PAD_BOTH); ?>
              <strong> Nationality : </strong><?= str_pad($model->getNation(),35,".",STR_PAD_BOTH); ?>
        </div>
        <div> <strong>Current address : </strong> <?= $model->addresspdf ?>  &emsp;
              <strong> Phone : </strong> <?= str_pad($model->phone,20,".",STR_PAD_BOTH); ?>&emsp;&emsp;
              <strong> E-mail : </strong> <?= str_pad($model->email,40,".",STR_PAD_BOTH); ?>
        </div>
        <div>   </div>
        <div> <strong> IDCard/Passport Number : </strong> <?= str_pad($model->idcard,30,".",STR_PAD_BOTH); ?> 
              <strong> Issued at : </strong> <?= str_pad($model->issued_at,30,".",STR_PAD_BOTH); ?>
              <strong>Date issue :</strong> <?= str_pad($model->date_issue,25,".",STR_PAD_BOTH); ?> 
        </div>
        <div> <strong>Passport Expires : </strong> <?= str_pad($model->passport_exp,25,".",STR_PAD_BOTH); ?>
              <strong>Visa Type :</strong> <?= str_pad($modelVisaDe->visaTypes->visa_name,25,".",STR_PAD_BOTH) ?>
              <strong> Visa Expires :</strong> <?= str_pad($modelVisaDe->visa_exp,25,".",STR_PAD_BOTH)?> 
        </div>

        <h4>Emergency Contact</h4>
        <?php
            
            $i = 1;
            foreach ( $model->getRfp() as $each) {

                ?>
              <strong>Name : </strong><?= str_pad($each['rela_name'],50,".",STR_PAD_BOTH); ?>
              <strong>Relationship : </strong><?= str_pad($each['relaship_name'],30,".",STR_PAD_BOTH);?>
              <strong>Phone : </strong><?= str_pad($each['rela_phone'],20,".",STR_PAD_BOTH); ?>
              <div><?= $each['addresspdf']?></div>
              <strong>E-mail :</strong> <?= str_pad($each['rela_email'],50,".",STR_PAD_BOTH);?>

                </tbody>
        <?php }
        ?> 
        <p style="text-align:left;">
        &emsp;&emsp;Resident will pay in advance for .........days basic service in the amount of ............baht. Resident will
        pay a refundable deposit in the amount of .............baht. Other expenses incurred during the resident stay such
        as medicines, visa services or physical therapy will be invoiced for payment at discharge.
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        &emsp;&emsp;ผู้พักอาศัยตกลงชำระเงินค่ามัดจำล่วงหน้า จำนวน ...........วัน เป็นจำนวนเงิน ..............บาท ผู้เข้าพักสามารถรับเงินค่ามัด
        จำคืนจำนวน .............บาท หากมีค่าใช้จ่ายเพิ่มเติมเกี่ยวข้องกับการบริการของบ้านดอกแก้ว เช่น ค่ายา การทำกายภาพบำบัด
        ค่าบริการติดต่อวีซ่า เป็นต้น บ้านดอกแก้วจะแจ้งรายการค่าใช้จ่ายใฟ้ผู้เข้าพักทราบ</p>

        </div>
        <div class = "row">
        <div style="text-align:right">ลงชื่อ/signed..................................ผู้ให้พักอาศัย/DK.Gardens&emsp;&emsp;&emsp;</div>
        </div>
        <div class = "row">
        <div style="text-align:right">( ..................................... )
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</div>
        </div>
        <div class = "row">
        <div style="text-align:right">ลงชื่อ/signed..................................ผู้พัก/Resident (Representative)</div>
        </div>
        <div class = "row">
        <div style="text-align:right">ลงชื่อ/signed..................................พยาน/Attestor
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;</div>
        </div>

        <div style="page-break-before: always;"></div>
        <div style="text-align:center;font-size:18px;"><b>PHYSICAL EXAM</b></div>
        <div style="text-align:center;font-size:18px;"><b>(Medical personnel to complete)</b></div>
        <div> <strong >Height :  </strong><?= str_pad($modelPhysical->height,10,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Weight :  </strong><?= str_pad($modelPhysical->weight,10,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Temperature :  </strong><?= str_pad($modelPhysical->temp,20,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Pulse :  </strong><?= str_pad($modelPhysical->pulse,20,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Respiratory :  </strong><?= str_pad($modelPhysical->respira,20,".",STR_PAD_BOTH); ?></div>
        <div><strong > Vision :  </strong><?= str_pad($modelPhysical->vision,30,"."); ?> &emsp;&emsp;&emsp;&emsp;&emsp;
        <strong > Hearing :  </strong><?= str_pad($modelPhysical->hearing,30,"."); ?>&emsp;&emsp;&emsp;&emsp;&emsp;
        <strong > Teeth :  </strong><?= str_pad($modelPhysical->teeth,30,"."); ?></div>
        <div><strong > Cardiac :  </strong><?= str_pad($modelPhysical->cardiac,160,"."); ?></div>
        <div><strong > Respiratory :  </strong><?= str_pad($modelPhysical->respiratory,154,"."); ?></div>
        <div><strong > Gastrointestinal :  </strong><?= str_pad($modelPhysical->gi,147,"."); ?></div>
        <div><strong > Genitourinary :  </strong><?= str_pad($modelPhysical->gini_touri,151,"."); ?></div>
        <div><strong > Neurological/mentation :  </strong><?= str_pad($modelPhysical->neurological,134,"."); ?></div>
        <div><strong > Neurovascular :  </strong><?= str_pad($modelPhysical->neurovascular,150,"."); ?></div>
        <div><strong > Integument :  </strong><?= str_pad($modelPhysical->integument,155,"."); ?></div>
        <div><strong > Assistive devices :  </strong><?= str_pad($modelPhysical->assis_devices,145,"."); ?></div>
        <div><strong > Summary of physical exam :  </strong><?= str_pad($modelPhysical->summary,1103,"."); ?></div>

        </div>
        <div class = "row">
        <div><strong>Examiner</strong><?=str_pad($model->fullname,80,".",STR_PAD_BOTH);?>
        <strong>Signature</strong><?=str_pad($modelPhysical->getSigDoctors(),40,".",STR_PAD_BOTH);?>
        <strong>Date</strong><?=str_pad($modelPhysical->exam_date,50,".",STR_PAD_BOTH);?>
        </div>
        </div>


        <div style="page-break-before: always;"></div>
        <div style="text-align:center;font-size:18px;"><b>HEALTH ASSESSMENT</b></div>
        <div style="text-align:center;font-size:14px;"><b>แบบประเมินสุขภาพ</b></div>
        <div> <strong >Name :  </strong><?= str_pad($model->fullname,110,".",STR_PAD_BOTH); ?>&ensp;
            <strong >Date of Birth :  </strong><?= str_pad($model->birth_date,50,".",STR_PAD_BOTH); ?></div>
            <div><strong > Symptom :  </strong><?= str_pad($modelHealth->symptom,142,".",STR_PAD_BOTH); ?></div>
        <div><strong > Last seen date:  </strong><?= str_pad($modelHealth->ls_doc,30,".",STR_PAD_BOTH); ?>&emsp;
        <strong > Last seen where :  </strong><?= str_pad($modelHealth->ls_where,85,".",STR_PAD_BOTH); ?>
        </div>
        <div><strong > Signature :  </strong><?= str_pad($modelHealth->getSigDoctors(),50,".",STR_PAD_BOTH); ?>&ensp;&ensp;
         <strong > Date Assessment :  </strong><?= str_pad($modelHealth->date_assessed,80,".",STR_PAD_BOTH); ?></div>


         <div style="page-break-before: always;"></div>
         <div style="text-align:center;font-size:14px;"><b>McKean Senior Center</b></div>
         <div style="text-align:center;font-size:18px;"><b>Dok Kaew Gardens</b></div>
        <div style="text-align:center;font-size:14px;"><b>MEDICATION SHEET (ใบบันทึกรายการยา)</b></div>
        <div> <strong >Fullname :  </strong><?= str_pad($model->fullname,100,".",STR_PAD_BOTH); ?></div>
        <div> <strong >Allergies :  </strong><?= str_pad($modelAllergies->aller_name,50,".",STR_PAD_BOTH); ?> 
        <strong > Birth date :  </strong><?= str_pad($model->birth_date,50,".",STR_PAD_BOTH); ?></div>

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
            foreach ( $model->getMrr() as $med) {

                ?>
            <tbody>
              <tr>
              <td><?= $i ?></td>
              <td><?= $med['date'] ?></td>
              <td><?= $med['med_name'] ?></td>
              <td><?= $med['med_dose']?> </td>
              <td><?= $med['med_route']?> </td>
              <td><?= $med['med_frequency']?> </td>
              <td><?= $med['med_purpose']?> </td>
                <td> <?= $med['med_time']?> </td>
                <td> <?= $med['dura_name']?> </td>
                <?=$i++?>
                </tbody>
        <?php }
        ?>

    </table>  