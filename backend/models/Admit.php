<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "admit".
 *
 * @property int $id
 * @property int $profile_id
 * @property string $admit_date
 * @property string|null $dc_date
 * @property int $dc_detail
 * @property string $ad_remark
 */
class Admit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admit';
    }
public $update_at;
public $detail;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id', 'admit_date', 'dc_detail', 'ad_remark'], 'required'],
            [['profile_id', 'dc_detail'], 'integer'],
            [['admit_date', 'dc_date'], 'safe'],
            [['ad_remark'], 'string'],
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
            'admit_date' => 'Admit Date',
            'dc_date' => 'Discharge Date',
            'dc_detail' => 'Discharge Detail',
            'ad_remark' => 'Remark',
            'update_at' => 'Update',
            'detail' => 'Discharge Detail'
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'admit_date',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function getProfiles()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    public function getDC()
    {
        return $this->hasOne(DcDetail::className(), ['id' => 'dc_detail']);
    }
}
