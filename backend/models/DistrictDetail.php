<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "district_detail".
 *
 * @property int $id
 * @property string $dt_code
 * @property string $dt_name
 * @property int $dt_geo_id
 * @property int $dt_province
 */
class DistrictDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['dt_code', 'dt_name', 'dt_geo_id', 'dt_province'], 'required'],
            [['dt_geo_id', 'dt_province'], 'integer'],
            [['dt_code'], 'string', 'max' => 4],
            [['dt_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt_code' => 'Dt Code',
            'dt_name' => 'Dt Name',
            'dt_geo_id' => 'Dt Geo ID',
            'dt_province' => 'Dt Province',
        ];
    }
}
