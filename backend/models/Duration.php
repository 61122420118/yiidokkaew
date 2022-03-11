<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "duration".
 *
 * @property int $id
 * @property string $dura_name
 * @property int $dura_status
 */
class Duration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'duration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dura_name'], 'required'],
            [['dura_status'], 'integer'],
            [['dura_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dura_name' => 'Duration Name',
            'dura_status' => 'Duration Status',
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'dura_status'=>[
            0 => 'Active',
            1 => 'No active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus()
    {
      return self::itemsAlias('dura_status');
    }
    public function getStatus(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->dura_status);
    }
}
