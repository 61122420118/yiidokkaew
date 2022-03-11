<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "doctor".
 *
 * @property int $id
 * @property string $sig_name
 * @property int $sig_status
 */
class Doctor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sig_name'], 'required'],
            [['sig_status'], 'integer'],
            [['sig_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sig_name' => 'Name',
            'sig_status' => 'Signature Status',
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'sig_status'=>[
            0 => 'Active',
            1 => 'No active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }
    public function getItemStatus()
    {
      return self::itemsAlias('sig_status');
    }
    public function getStatus(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->sig_status);
    }
}
