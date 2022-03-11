<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "visa_detail".
 *
 * @property int $id
 * @property int $visa_id
 * @property int $visa_type
 * @property string $visa_issue
 * @property string $visa_exp
 */
class VisaDetail extends \yii\db\ActiveRecord
{
    public $visa_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visa_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['visa_id', 'visa_type', 'visa_issue', 'visa_exp'], 'required'],
            [['visa_id', 'visa_type'], 'integer'],
            [['visa_issue', 'visa_exp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visa_id' => 'Visa ID',
            'visa_type' => 'Visa Type',
            'visa_issue' => 'Visa Issue',
            'visa_exp' => 'Visa Expire',
            'visa_name' => 'Visa Name',

        ];
    }
    public function getDateVisa()
    {
    return 'Visa Issue : '.$this->visa_issue.', Visa Expire : '.$this->visa_exp;
    }
    public function getVisaDetails()
    {
        return $this->hasOne(Visa::className(), ['profile_id' => 'visa_id']);
    }
    public function getVisaTypes()
    {
        return $this->hasOne(VisaType::className(), ['id' => 'visa_type']);
    }
    public function getVisasd()
    {
        return $this->hasOne(Profile::className(), ['id' => 'visa_id']);
    }



}
