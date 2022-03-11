<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subdistrict_detail".
 *
 * @property int $id
 * @property string $sd_code
 * @property string $sd_name
 * @property int $sd_district
 * @property int $sd_province
 * @property int $sv_geo_id
 */
class SubdistrictDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subdistrict_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['sd_code', 'sd_name', 'sd_district', 'sd_province', 'sv_geo_id'], 'required'],
            [['sd_district', 'sd_province', 'sv_geo_id'], 'integer'],
            [['sd_code'], 'string', 'max' => 6],
            [['sd_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sd_code' => 'Sd Code',
            'sd_name' => 'Sd Name',
            'sd_district' => 'Sd District',
            'sd_province' => 'Sd Province',
            'sv_geo_id' => 'Sv Geo ID',
        ];
    }
}
