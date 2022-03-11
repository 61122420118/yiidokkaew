<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "med_time".
 *
 * @property int $id
 * @property string $medtime_name
 */
class MedTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'med_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['medtime_name'], 'required'],
            [['medtime_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medtime_name' => 'Medtime Name',
        ];
    }
    public function getTimes()
    {
        return $this->hasMany(MedicationDetail::className(), ['med_time' => 'id']);
    }
}
