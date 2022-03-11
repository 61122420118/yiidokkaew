<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "medication_detail".
 *
 * @property int $id
 * @property int $med_id
 * @property string $date
 * @property string $med_name
 * @property string $med_dose
 * @property int|null $med_route
 * @property string $med_frequency
 * @property string $med_purpose
 * @property string|null $med_time
 * @property int $med_duration
 * @property int $med_status
 */
class MedicationDetail extends \yii\db\ActiveRecord
{
    public $dura_name;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
{
    return [
        [
            'class' => AttributeBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => 'med_time',
                ActiveRecord::EVENT_BEFORE_UPDATE => 'med_time',
            ],
            'value' => function ($event) {
                return implode(',', $this->med_time);
            },
        ],
    ];
}
    public static function tableName()
    {
        return 'medication_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['med_id', 'date', 'med_name', 'med_dose', 'med_frequency', 'med_purpose', 'med_status'], 'required'],
            [['med_id', 'med_route', 'med_duration', 'med_status'], 'integer'],
            [['date','med_time'], 'safe'],
            [['med_name'], 'string', 'max' => 70],
            [['med_dose', 'med_purpose'], 'string', 'max' => 30],
            [['med_frequency'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'med_id' => 'Med ID',
            'date' => 'Date',
            'med_name' => 'Medication Name',
            'med_dose' => 'Dose',
            'med_route' => 'Route',
            'med_frequency' => 'Frequency',
            'med_purpose' => 'Purpose of Medication ',
            'med_time' => 'Medication Time',
            'med_duration' => 'Duration',
            'med_status' => 'Status',
            'dura_name' => 'Duration',
            'skillToArray' => 'skillToArray'
        ];
    }
    public static function itemsAlias($key){

        $items = [

            'med_time'=>[
            'Morning' => 'Morning',
            'Noon' => 'Noon',
            'Evening' => 'Evening',
            'Bedtime' => 'Bedtime',
        ]
      ];
        return ArrayHelper::getValue($items,$key,[]);
        //return array_key_exists($key, $items) ? $items[$key] : [];
      }
      public function getItemSkill()
      {
        return self::itemsAlias('med_time');
      }
    public function skillToArray()
    {
      return $this->med_time = explode(',', $this->med_time);
    }
    public function getSkillName(){
        $skills = $this->getItemSkill();
        $skillSelected = explode(',', $this->med_time);
        $skillSelectedName = [];
        foreach ($skills as $key => $skillName) {
          foreach ($skillSelected as $skillKey) {
            if($key === $skillKey){
              $skillSelectedName[] = $skillName;
            }
          }
        }
    
        return implode(', ', $skillSelectedName);
    }

    public function getRoutes()
    {
        return $this->hasOne(Route::className(), ['id' => 'med_route']);
    }
    public function getMedDetails()
    {
        return $this->hasOne(Medication::className(), ['profile_id' => 'med_id']);
    }
    public function getMedDura()
    {
        return $this->hasOne(Duration::className(), ['id' => 'med_duration']);
    }
    public function getMedicationDes()
    {
        return $this->hasOne(Profile::className(), ['id' => 'med_id']);
    }

    public function getRouteName()
    {
        return $this->routes->route_name;
    }
}
