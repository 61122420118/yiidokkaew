<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "province_detail".
 *
 * @property int $id
 * @property string $pv_code
 * @property string $pv_name
 * @property int $pv_geo_id
 * @property int $pv_status
 */
class ProvinceDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['pv_code', 'pv_name', 'pv_geo_id'], 'required'],
            [['pv_geo_id', 'pv_status'], 'integer'],
            [['pv_code'], 'string', 'max' => 2],
            [['pv_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pv_code' => 'Pv Code',
            'pv_name' => 'Pv Name',
            'pv_geo_id' => 'Pv Geo ID',
            'pv_status' => 'Pv Status',
        ];
    }
}
