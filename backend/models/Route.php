<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property int $id
 * @property string $route_name
 * @property int $route_status
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_name'], 'required'],
            [['route_status'], 'integer'],
            [['route_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_name' => 'Route Name',
            'route_status' => 'Route Status',
        ];
    }
}
