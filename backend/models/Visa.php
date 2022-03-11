<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "visa".
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $create_at
 * @property string $update_at
 */
class Visa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visa';
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
    public function getVisaDetails()
    {
        return $this->hasMany(VisaDetail::className(), ['visa_id' => 'profile_id']);
    }
    public function getProfiles()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
    public function getCreate()
    {
    return 'Create : '.$this->create_at.', Update : '.$this->update_at;
    }
}

