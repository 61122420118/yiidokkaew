<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "relationship".
 *
 * @property int $id
 * @property string $relaship_name
 * @property int $relaship_status
 */
class Relationship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relationship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['relaship_name'], 'required'],
            [['relaship_status'], 'integer'],
            [['relaship_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'relaship_name' => 'Relationship Name',
            'relaship_status' => 'Relationship Status',
        ];
    }
    public static function itemsAlias($key){

        $items = [
          
          'relaship_status'=>[
            0 => 'Active',
            1 => 'No active'

            
        ]
      ];
      return ArrayHelper::getValue($items,$key,[]);
      //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus()
    {
      return self::itemsAlias('relaship_status');
    }
    public function getStatus(){
        return ArrayHelper::getValue($this->getItemStatus(),$this->relaship_status);
    }

    public function getRelations()
    {
        return $this->hasMany(Relative::className(), ['relaship_id' => 'id']);
    }
}
