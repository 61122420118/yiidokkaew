<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use backend\models\Doctor;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "physical".
 *
 * @property int $id
 * @property int $profile_id
 * @property float $height
 * @property float $weight
 * @property float $temp
 * @property int $pulse
 * @property int $respira
 * @property string|null $vision
 * @property string|null $hearing
 * @property string|null $teeth
 * @property string|null $cardiac
 * @property string|null $respiratory
 * @property string|null $gi
 * @property string|null $gini_touri
 * @property string|null $neurological
 * @property string|null $neurovascular
 * @property string|null $integument
 * @property string|null $assis_devices
 * @property string|null $summary
 * @property string|null $doctor
 * @property string $exam_date
 * @property int $user
 * @property string $create_at
 * @property string $update_at
 */
class Physical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $usernames;
    public $examine;
    public $fullname;
    public static function tableName()
    {
        return 'physical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['profile_id', 'height', 'weight', 'temp', 'pulse', 'respira', 'exam_date', 'user'], 'required'],
            [['profile_id', 'pulse', 'respira', 'user'], 'integer'],
            [['height', 'weight', 'temp'], 'number'],
            [['summary'], 'string'],
            [['examiner'], 'string', 'max' => 80],
            [['exam_date', 'create_at', 'update_at'], 'safe'],
            [['vision', 'hearing', 'teeth'], 'string', 'max' => 50],
            [['cardiac', 'respiratory', 'gi', 'gini_touri', 'neurological', 'neurovascular', 'integument', 'assis_devices', 'doctor'], 'string', 'max' => 100],
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
            'height' => 'Height',
            'weight' => 'Weight',
            'temp' => 'Temperature',
            'pulse' => 'Pulse',
            'respira' => 'Respiration',
            'vision' => 'Vision',
            'hearing' => 'Hearing',
            'teeth' => 'Teeth',
            'cardiac' => 'Cardiac',
            'respiratory' => 'Respiratory',
            'gi' => 'Gastrointestinal',
            'gini_touri' => 'Genitourinary',
            'neurological' => 'Neurological/mentation',
            'neurovascular' => 'Neurovascular',
            'integument' => 'Integument',
            'assis_devices' => 'Assistive devices',
            'summary' => 'Summary of physical exam',
            'examiner' => 'Examiner',
            'examine' => 'Examiner',
            'doctor' => 'Doctor',
            'doc' => 'Info',
            'exam_date' => 'Exam Date',
            'user' => 'User',
            'create_at' => 'Create At',
            'update_at' => 'Update At',


        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
    public function getProfiles()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    public function getDocs()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor']);
    }

    public function getSigDoctors()
    {
        return $this->docs->sig_name;
    }

    public function getData()
    {
    return 'Height : '.$this->height.', Weight : '.$this->weight;
    }
    public function getVisions()
    {
    return 'Vision : '.$this->vision.', Hearing : '.$this->hearing.', Teeth : '.$this->teeth;;
    }
    public function getDoc()
    {
    return 'Examiner : '.$this->profiles->fullname.' Doctor : '.$this->docs->sig_name.', Exam date : '.$this->exam_date.', Fill by : '.$this->users->username;
    }
    public function getTemperate()
    {
    return 'Temperature : '.$this->temp.', Pulse : '.$this->pulse.', Respiration : '.$this->respira;
    }
    public function getCreate()
    {
    return 'Create : '.$this->create_at.', Update : '.$this->update_at;
    }
}
