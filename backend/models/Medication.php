<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "medication".
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $create_at
 * @property string|null $update_at
 */
class Medication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id'], 'required'],
            [['profile_id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
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
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getMedDetails()
    {
        return $this->hasMany(MedicationDetail::className(), ['med_id' => 'profile_id']);
    }
    public function getProfiles()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
    public function getCreate()
    {
    return 'Create : '.$this->create_at.', Update : '.$this->update_at;
    }
    public function getRfp() 
    {
        
         $rfp = MedicationDetail::find()->select(['date','med_name','med_purpose','med_dose','med_route','med_frequency',
         'med_time','med_duration','dura_name','med_status'])
        
                ->joinWith(['medDetails'])
                ->joinWith(['medDura'])

                

                ->andwhere(['profile_id'=> $this->profile_id])->all();


        return $rfp;
    }
}
