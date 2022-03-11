<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "symptom_detail".
 *
 * @property int $id
 * @property string $symp_name
 * @property int $symp_status
 */
class SymptomDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    public static function tableName()
    {
        return 'symptom_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['symp_name'], 'required'],
            [['symp_status'], 'integer'],
            [['symp_name'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'symp_name' => 'Symptom Name',
            'symp_status' => 'Symptom Status',
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'symp_status'=>[
            0 => 'Active',
            1 => 'No active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus()
    {
      return self::itemsAlias('symp_status');
    }
    public function getStatus(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->symp_status);
    }
    public function skillToArray()
    {
      return $this->symp_name = explode(',', $this->symp_name);
    }

    public function getSkillName(){
        $skills = $this->getItemSkill();
        $skillSelected = explode(',', $this->skill);
        $skillSelectedName = [];
        foreach ($skills as $key => $symp_name) {
          foreach ($skillSelected as $skillKey) {
            if($key === $skillKey){
              $skillSelectedName[] = $symp_name;
            }
          }
        }
    
        return implode(', ', $skillSelectedName);
    }
}
