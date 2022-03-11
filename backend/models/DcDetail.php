<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "dc_detail".
 *
 * @property int $id
 * @property string $detail
 * @property int $status
 */
class DcDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dc_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail', 'status'], 'required'],
            [['status'], 'integer'],
            [['detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail' => 'Detail',
            'status' => 'Status',
            'statusset' => 'Status'
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'status'=>[
            0 => 'Active',
            1 => 'No active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus()
    {
      return self::itemsAlias('status');
    }
    public function getStatusset(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->status);
    }
}
