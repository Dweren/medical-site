<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reception".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $user_id
 * @property string $started_at
 *
 * @property Doctor $doctor
 * @property User $user
 */
class Reception extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reception';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'user_id'], 'integer'],
            [['started_at'], 'safe'],
            [['started_at', 'doctor_id'], 'unique', 'targetAttribute' => ['started_at', 'doctor_id']],
            [
                ['doctor_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Doctor::className(),
                'targetAttribute' => ['doctor_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'doctor_id' => 'Доктор',
            'user_id' => 'Пациент',
            'started_at' => 'Назначено на',
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
