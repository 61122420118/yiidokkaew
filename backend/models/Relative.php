<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "relative".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $rela_name
 * @property int $relaship_id
 * @property string|null $rela_house_no
 * @property int|null $village_no
 * @property string|null $alley
 * @property string|null $road
 * @property string|null $sub_district
 * @property string|null $district
 * @property string $province
 * @property int|null $post
 * @property string $country
 * @property string $rela_phone
 * @property string|null $rela_email
 * @property int $rela_status
 * @property string $create_at
 * @property string $update_at
 */
class Relative extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public $relaship_name;
    public $visa_type;


    public static function tableName()
    {
        return 'relative';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id', 'rela_name', 'relaship_id', 'province', 'country', 'rela_phone', 'create_at'], 'required'],
            [['profile_id', 'relaship_id', 'rela_village_no', 'rela_post', 'rela_status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['rela_name', 'rela_email'], 'string', 'max' => 100],
            [['rela_house_no', 'rela_phone'], 'string', 'max' => 10],
            [['rela_alley'], 'string', 'max' => 20],
            [['rela_road', 'rela_sub_district', 'rela_district', 'rela_province', 'rela_country'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profile_id' => 'Profile ID',
            'rela_name' => 'Name',
            'relaship_id' => 'Relationship Name',
            'rela_house_no' => 'House No',
            'rela_village_no' => 'Village No',
            'rela_alley' => 'Alley',
            'rela_road' => 'Road',
            'rela_sub_district' => 'Sub District',
            'rela_district' => 'District',
            'rela_province' => 'Province',
            'rela_post' => 'Post',
            'rela_country' => 'Country',
            'rela_phone' => 'Phone',
            'rela_email' => 'Email',
            'rela_status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'countrys.ct_nameENG' => 'Country',
            'subdistricts.sd_name' => 'Sub District',
            'districts.dt_name' => 'District',
            'provinces.pv_name' => 'Province',
            'relatives.fullname' => 'Fullname patient',
            'address1' => 'Address',
            'relaship_name' => 'Relationship',
            'visa_type' => 'Visa type'
        ];
    }

    
    public static function itemsAlias($key){

        $items = [
          
          'rela_status'=>[
            0 => 'Active',
            1 => 'No Active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }


    public function getRelations()
    {
        return $this->hasOne(Relationship::className(), ['id' => 'relaship_id']);
    }

    public function getRelatives()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    public function getItemStatus()
    {
      return self::itemsAlias('rela_status');
    }

    public function skillToArray()
    {
      return $this->rela_status = explode(',', $this->rela_status);
    }

    public function getStatus(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->rela_status);
    }

    public function getProvinces()
    {
        return $this->hasOne(ProvinceDetail::className(), ['id' => 'rela_province']);
    }

    public function getSubdistricts()
    {
        return $this->hasOne(SubdistrictDetail::className(), ['id' => 'rela_sub_district']);
    }
    public function getDistricts()
    {
        return $this->hasOne(DistrictDetail::className(), ['id' => 'rela_district']);
    }
    public function getCountrys()
    {
        return $this->hasOne(CountryDetail::className(), ['id' => 'rela_country']);
    }

    public function getAddress1()
    {
    return 'House no : '.$this->rela_house_no.', Village no : '.$this->rela_village_no.', Alley : '.$this->rela_alley.', Road : '.
    $this->rela_road.', Sub disrtict : '.$this->rela_sub_district.', District : '.$this->rela_district.', Province : '.$this->rela_province.
    ', Country : '.$this->countrys->ct_nameENG.', Post : '.$this->rela_post;
    }
    public function getAddresspdf()
    {
    return '<b>House no : </b>'.str_pad($this->rela_house_no,15,".",STR_PAD_BOTH).'<b> Village no : </b>'.
    str_pad($this->rela_village_no,15,".",STR_PAD_BOTH).'<b> Alley : </b>'.
    str_pad($this->rela_alley,15,".",STR_PAD_BOTH).'<b> Road : </b>'.str_pad($this->rela_road,15,".",STR_PAD_BOTH).'<b> Sub disrtict : </b>'.
    str_pad($this->rela_sub_district,30,".",STR_PAD_BOTH).' <b>District :</b> '.str_pad($this->rela_district,30,".",STR_PAD_BOTH).'<b> Province : </b>'.
    str_pad($this->rela_province,30,".",STR_PAD_BOTH).'<b> Post : </b>'.str_pad($this->rela_post,15,".",STR_PAD_BOTH);
    }
    public function getCreate()
    {
    return 'Create : '.$this->create_at.', Update : '.$this->update_at;
    }

    
}
