<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "health".
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $symptom
 * @property string|null $ls_doc
 * @property string|null $ls_where
 * @property string|null $sig_health
 * @property string|null $date_assessed
 * @property int $user
 * @property string $create_at
 * @property string $update_at
 */
class Health extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $usernames;
    public static function tableName()
    {
        return 'health';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id', 'user', 'create_at'], 'required'],
            [['profile_id', 'user'], 'integer'],
            [['symptom'], 'string'],
            [['ls_doc', 'date_assessed', 'create_at', 'update_at'], 'safe'],
            [['ls_where'], 'string', 'max' => 70],
            [['sig_health'], 'string', 'max' => 100],
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
            'symptom' => 'Symptom',
            'ls_doc' => 'Last seen Doctor',
            'ls_where' => 'Last seen Where',
            'sig_health' => 'Sig Health',
            'date_assessed' => 'Date Assessed',
            'user' => 'User',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'usernames' => 'Usernames',
            'doc' => 'Doctor',
            'lS' => 'Last seen'
        ];
    }

  
    public function getSymptoms()
    {
        return $this->hasMany(SymptomDetail::className(), ['id' => 'symptom']);
    }


    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    public function getDocs()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'sig_health']);
    }

    public function getSigDoctors()
    {
        return $this->docs->sig_name;
    }

    public function getItemStatuss()
    {
      return self::itemsAlias('symptom');
    }
    public function getProfiles()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
    public function getLS()
    {
    return 'Last seen Doctor at : '.$this->ls_doc.', Last seen Where : '.$this->ls_where;
    }
    public function getDoc()
    {
    return 'Doctor : '.$this->docs->sig_name.', Date Assessed : '.$this->date_assessed;
    }
    public function getCreate()
    {
    return 'Create : '.$this->create_at.', Update : '.$this->update_at;
    }

}
