<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country_detail".
 *
 * @property int $id
 * @property string $ct_nameENG
 * @property string $ct_nameTHA
 * @property int $ct_status
 */
class CountryDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['ct_nameENG', 'ct_nameTHA'], 'required'],
            [['ct_status'], 'integer'],
            [['ct_nameENG', 'ct_nameTHA'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ct_nameENG' => 'Ct Name Eng',
            'ct_nameTHA' => 'Ct Name Tha',
            'ct_status' => 'Ct Status',
        ];
    }


}
