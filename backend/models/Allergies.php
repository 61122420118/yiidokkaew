<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "allergies".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $aller_name
 * @property int $aller_status
 */
class Allergies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allergies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id', 'aller_name'], 'required'],
            [['profile_id', 'aller_status'], 'integer'],
            [['aller_name'], 'string', 'max' => 50],
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
            'aller_name' => 'Allergies',
            'aller_status' => 'Aller Status',
        ];
    }
}
