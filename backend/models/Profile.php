<?php

namespace backend\models;

use Yii;
use backend\models\Visa;
use backend\models\Relative;
use backend\models\Medication;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
use DateTime;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string|null $dk_code
 * @property string $lastname
 * @property string $firstname
 * @property string $middlename
 * @property string $birth_date
 * @property int $nationality
 * @property int $age
 * @property string|null $house_no
 * @property int|null $village_no
 * @property string|null $alley
 * @property string|null $road
 * @property string|null $sub_district
 * @property string|null $district
 * @property string $province
 * @property int|null $post
 * @property string $country
 * @property string|null $phone
 * @property string|null $email
 * @property string $idcard
 * @property string $issued_at
 * @property string $date_issue
 * @property string $passport_exp
 * @property int $user
 * @property string $create_at
 * @property string $update_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $usernames;
    public $Relatives;
    public $totalamount;
    public $amount;
    public $dis;
    public $ages;
    public $diff;
    public $totaldis;
    public $people;
    public $totalpeople;
    public $peopledis;
    public $totalpeopledis;
    public $totaljan;
    public $jan;
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['lastname', 'firstname', 'middlename', 'birth_date', 'nationality', 'sex', 'province', 'country', 'idcard', 'issued_at', 'date_issue', 'passport_exp', 'user', 'create_at'], 'required'],
            [['birth_date', 'date_issue', 'passport_exp', 'create_at', 'update_at'], 'safe'],
            [['nationality', 'sex', 'village_no','status', 'post', 'user'], 'integer'],
            [['dk_code'], 'string', 'max' => 6],
            [['lastname', 'firstname', 'middlename', 'road', 'sub_district', 'district', 'province', 'country', 'idcard'], 'string', 'max' => 30],
            [['house_no'], 'string', 'max' => 10],
            [['phone'], 'string'],
            [['alley'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['issued_at'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dk_code' => 'Dk Code',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'birth_date' => 'Birth Date',
            'nationality' => 'Nationality',
            'sex' => 'Sex',
            'house_no' => 'House No',
            'village_no' => 'Village No',
            'alley' => 'Alley',
            'road' => 'Road',
            'sub_district' => 'Sub District',
            'district' => 'District',
            'province' => 'Province',
            'post' => 'Post',
            'country' => 'Country',
            'phone' => 'Phone',
            'email' => 'Email',
            'idcard' => 'Idcard',
            'issued_at' => 'Issued At',
            'date_issue' => 'Date Issue',
            'passport_exp' => 'Passport Expires',
            'user' => 'User',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'usernames' => 'Fill by',
            'countrys.ct_nameENG' => 'Country',
            'nationalitys.ct_nameENG' => 'Nationality',
            'Relatives' => 'Relatives',
            'status' => 'Status',
            'statustext' => 'Status',
            'sextext' => 'Sex'
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'status'=>[
            0 => 'Active',
            1 => 'No active'
          ],
          'sex'=>[
            1 => 'Male',
            2 => 'Female'
          ],
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus()
    {
      return self::itemsAlias('status');
    }
    public function getItemSex()
    {
    return self::itemsAlias('sex');
    }
    public function getStatustext(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->status);
    }
    public function getSextext(){
        return ArrayHelper::getValue($this->getItemSex(),$this->sex);
    }
    public function getBdateCalculation()

    {
    
    $datetime1 = new DateTime($this->birth_date);
    
    $datetime2 = new DateTime();
    
    $diff = $this->birth_date->diff($datetime2);
    
    return $diff->y;
    
    }

    public function getAge()
    {
        
        $dob = new DateTime($this->birth_date);
        
        $now = new DateTime();
         
        $difference = $now->diff($dob);
         
        $ages = $difference->y;
         
        return  $ages;
    }
    public function getAdmits()
    {
        return $this->hasOne(Admit::className(), ['profile_id' => 'id']);
    }

    public function getRelatives()
    {
        return $this->hasMany(Relative::className(), ['profile_id' => 'id']);
    }

    public function getMedications()
    {
        return $this->hasMany(Medication::className(), ['profile_id' => 'id']);
    }


    public function getNeeds()
    {
        return $this->hasMany(NeededMed::className(), ['profile_id' => 'id']);
    }

    public function getHealths()
    {
        return $this->hasMany(Health::className(), ['profile_id' => 'id']);
    }

    public function getPhysicals()
    {
        return $this->hasMany(Physical::className(), ['profile_id' => 'id']);
    }

    public function getAllers()
    {
        return $this->hasMany(Allergies::className(), ['profile_id' => 'id']);
    }

    public function getVisas()
    {
        return $this->hasOne(Visa::className(), ['profile_id' => 'id']);
    }
    public function getVisasd()
    {
        return $this->hasMany(VisaDetail::className(), ['visa_id' => 'id']);
    }

    public function getUsers()
        {
            return $this->hasOne(User::className(), ['id' => 'user']);
        }

        public function getCountrys()
        {
            return $this->hasOne(CountryDetail::className(), ['id' => 'country']);
        }

        public function getNationalitys()
        {
            return $this->hasOne(CountryDetail::className(), ['id' => 'nationality']);
        }

        public function getProvinces()
        {
            return $this->hasOne(ProvinceDetail::className(), ['id' => 'province']);
        }

        public function getSubdistricts()
        {
            return $this->hasOne(SubdistrictDetail::className(), ['id' => 'sub_district']);
        }
        public function getDistricts()
        {
            return $this->hasOne(DistrictDetail::className(), ['id' => 'district']);
        }

          public function getFullName()
            {
            return $this->lastname.' '.$this->firstname.' '.$this->middlename;
            }
            public function getBirth()
            {
            return $this->birth_date;
            }
            public function getCard()
            {
            return 'Number : '.$this->idcard.', At : '.$this->issued_at.', Issue : '.$this->date_issue.', Expires : '.$this->passport_exp;
            }
            public function getCreate()
            {
            return 'Create : '.$this->create_at.', Update : '.$this->update_at;
            }
            public function getNation()
            {
            return $this->nationalitys->ct_nameENG;
            }
            public function getVisaType()
            {
            return 'Visa type : '.$this->visasd->visa_type;
            }
            public function getAddress()
            {
            return 'House no : '.$this->house_no.', Village no : '.$this->village_no.', Alley : '.$this->alley.', Road : '.
            $this->road.', Sub disrtict : '.$this->sub_district.', District : '.$this->district.', Province : '.$this->province.
            ', Post : '.$this->post.', Country : '.$this->countrys->ct_nameENG ;
            }

            public function getAddresspdf()
            {
            return '<b>House no : </b>'.str_pad($this->house_no,15,".",STR_PAD_BOTH).'<b> Village no : </b>'
            .str_pad($this->village_no,15,".",STR_PAD_BOTH).'<b> Alley : </b>'.str_pad($this->alley,35,".",STR_PAD_BOTH).'<b> Road : </b>'.
            str_pad($this->road,35,".",STR_PAD_BOTH).'<b> Sub disrtict : </b>'.str_pad($this->sub_district,30,".",STR_PAD_BOTH).'<b> District : </b>'.
            str_pad($this->district,30,".",STR_PAD_BOTH).'<b> Province : </b>'.str_pad($this->province,30,".",STR_PAD_BOTH).
            '<b> Post : </b>'.str_pad($this->post,15,".",STR_PAD_BOTH).'<b> Country : </b>'.str_pad($this->countrys->ct_nameENG,30,".",STR_PAD_BOTH);
            }

            public function getRfp() 
            {
                
                 $rfp = Relative::find()->select(['rela_name','rela_house_no','rela_village_no','rela_alley','rela_road','rela_sub_district',
                 'rela_district','rela_province','rela_post','relaship_name','rela_phone','rela_email'])
                
                        ->joinWith(['relatives'])
                        ->joinWith(['relations'])

                        
        
                        ->andwhere(['profile_id'=> $this->id])->all();
        
        
                return $rfp;
            }

            public function getMedDetails()
            {
                return $this->hasMany(MedicationDetail::className(), ['med_id' => 'id']);
            }

            public function getMrr() 
            {
                 $mrr = MedicationDetail::find()->select(['date','med_name','med_purpose','med_dose','med_route','med_frequency',
                 'med_time','med_duration','dura_name','med_status'])
                
                        ->joinWith(['medDetails'])
                        ->joinWith(['medDura'])

                        ->andwhere(['profile_id'=> $this->id])->all();
        
                return $mrr;
            }


            public function getVisadetail() 
            {
                 $visad = VisaDetail::find()->select(['visa_type','visa_issue','visa_exp','visa_name'])
                
                        ->joinWith(['visasd'])
                        ->joinWith(['visaTypes'])
                        
                        ->andwhere(['visa_id'=> $this->id])->all();
        
                return $visad;
            }
            public function getMedicationDetail() 
            {
                 $med = MedicationDetail::find()->select(['date','med_name','med_dose','med_route','med_frequency',
                 'med_purpose','med_time','med_duration','dura_name'])
                
                        ->joinWith(['medicationDes'])
                        ->joinWith(['medDura'])

                        
                        ->andwhere(['med_id'=> $this->id])->all();
        
                return $med;
            }
            public function getPhysic() 
            {
                 $phy = Physical::find()->select(['height', 'weight', 'temp', 'pulse', 'respira','summary','cardiac', 'respiratory', 'gi',
                  'gini_touri', 'neurological', 'neurovascular', 'integument', 'assis_devices', 'doctor','vision', 'hearing', 'teeth',
                  'exam_date','examiner'])
                
                        ->joinWith(['profiles'])


                        
                        ->andwhere(['profile_id'=> $this->id])->all();
        
                return $phy;
            }

            public function getHeal() 
            {
                 $heal = Health::find()->select(['symptom', 'ls_doc', 'ls_where', 'sig_health','date_assessed'])
                
                        ->joinWith(['profiles'])


                        
                        ->andwhere(['profile_id'=> $this->id])->all();
        
                return $heal;
            }

            public function getAdmitview() 
            {
                 $admit = Admit::find()->select(['admit_date', 'dc_date', 'dc_detail', 'ad_remark','detail'])
                
                        ->joinWith(['profiles'])
                        ->joinWith(['dC'])


                        
                        ->andwhere(['profile_id'=> $this->id])->all();
        
                return $admit;
            }

            public function getTotalAdmit(){
                $amount = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y-m').'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y-m').'-31'])
                ->count();
    
                $totalamount = $amount;
                return $totalamount;
            }

            public function getTotalDischarge(){
                $dis = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y-m').'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y-m').'-31'])
                ->count();
    
                $totaldis = $dis;
                return $totaldis;
            }

            public function getTotal(){
                $people = Profile::find()
                ->where(['status' => 0])
                ->count();
    
                $totalpeople = $people;
                return $totalpeople;
            }

            public function getTotalDis(){
                $peopledis = Profile::find()
                ->where(['status' => 1])
                ->count();
    
                $totalpeopledis = $peopledis;
                return $totalpeopledis;
            }

            public function getJan(){
                $jan = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-01'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-01'.'-31'])
                ->count();
    
                $totaljan = $jan;
                return $totaljan;
            }

            public function getFeb(){
                $feb = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-02'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-02'.'-31'])
                ->count();
    
                $totalfeb = $feb;
                return $totalfeb;
            }

            public function getMar(){
                $mar = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-03'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-03'.'-31'])
                ->count();
    
                $totalmar = $mar;
                return $totalmar;
            }

            public function getApr(){
                $apr = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-04'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-04'.'-31'])
                ->count();
    
                $totalapr = $apr;
                return $totalapr;
            }

            public function getMay(){
                $may = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-05'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-05'.'-31'])
                ->count();
    
                $totalmay = $may;
                return $totalmay;
            }

            public function getJune(){
                $june = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-06'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-06'.'-31'])
                ->count();
    
                $totaljune = $june;
                return $totaljune;
            }

            public function getJuly(){
                $july= Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-07'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-07'.'-31'])
                ->count();
    
                $totaljuly = $july;
                return $totaljuly;
            }

            public function getAug(){
                $aug = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-08'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-08'.'-31'])
                ->count();
    
                $totalaug = $aug;
                return $totalaug;
            }

            public function getSep(){
                $sep = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-09'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-09'.'-31'])
                ->count();
    
                $totalsep = $sep;
                return $totalsep;
            }

            public function getOct(){
                $oct = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-10'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-10'.'-31'])
                ->count();
    
                $totaloct = $oct;
                return $totaloct;
            }

            public function getNov(){
                $nov = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-11'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-11'.'-31'])
                ->count();
    
                $totalnov = $nov;
                return $totalnov;
            }

            public function getDec(){
                $dec = Profile::find()
        ->where('create_at >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-12'.'-01'])
        ->andwhere('create_at <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-12'.'-31'])
                ->count();
    
                $totaldec = $dec;
                return $totaldec;
            }

            public function getDisJan(){
                $jan = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-01'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-01'.'-31'])
                ->count();
    
                $totaljan = $jan;
                return $totaljan;
            }

            public function getDisFeb(){
                $feb = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-02'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-02'.'-31'])
                ->count();
    
                $totalfeb = $feb;
                return $totalfeb;
            }

            public function getDisMar(){
                $mar = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-03'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-03'.'-31'])
                ->count();
    
                $totalmar = $mar;
                return $totalmar;
            }

            public function getDisApr(){
                $apr = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-04'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-04'.'-31'])
                ->count();
    
                $totalapr = $apr;
                return $totalapr;
            }

            public function getDisMay(){
                $may = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-05'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-05'.'-31'])
                ->count();
    
                $totalmay = $may;
                return $totalmay;
            }

            public function getDisJune(){
                $june = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-06'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-06'.'-31'])
                ->count();
    
                $totaljune = $june;
                return $totaljune;
            }

            public function getDisJuly(){
                $july= Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-07'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-07'.'-31'])
                ->count();
    
                $totaljuly = $july;
                return $totaljuly;
            }

            public function getDisAug(){
                $aug = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-08'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-08'.'-31'])
                ->count();
    
                $totalaug = $aug;
                return $totalaug;
            }

            public function getDisSep(){
                $sep = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-09'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-09'.'-31'])
                ->count();
    
                $totalsep = $sep;
                return $totalsep;
            }

            public function getDisOct(){
                $oct = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-10'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-10'.'-31'])
                ->count();
    
                $totaloct = $oct;
                return $totaloct;
            }

            public function getDisNov(){
                $nov = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-11'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-11'.'-31'])
                ->count();
    
                $totalnov = $nov;
                return $totalnov;
            }

            public function getDisDec(){
                $dec = Admit::find()
        ->where('dc_date >= :from_date' , [':from_date'=> $this->from_date = date('Y').'-12'.'-01'])
        ->andwhere('dc_date <= :to_date' , [':to_date'=> $this->to_date = date('Y').'-12'.'-31'])
                ->count();
    
                $totaldec = $dec;
                return $totaldec;
            }
}
