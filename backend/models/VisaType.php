<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "visa_type".
 *
 * @property int $id
 * @property string $visa_name
 * @property int $visa_status
 */
class VisaType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visa_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['visa_name'], 'required'],
            [['visa_status'], 'integer'],
            [['visa_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visa_name' => 'Visa Name',
            'visa_status' => 'Visa Status',
        ];
    }
}
