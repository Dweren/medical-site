<?php

namespace app\models;

use app\models\Reception;
use yii\base\Model;
use Yii;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ReceptionForm extends Model
{
    public $doctor_id;
    public $user_id;
    public $date;
    public $time;

    public function rules()
    {
        return [
            [['doctor_id', 'user_id'], 'integer'],
            [['date', 'time'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doctor_id' => 'Доктор',
            'date' => 'Дата',
            'time' => 'Время',
        ];
    }

    public function formName()
    {
        return 'ReceptionForm';
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $model = new Reception;
        $model->setAttributes($this->attributes);
        $timestamp = strtotime($this->date . ' ' . $this->time);
        $model->started_at = date("Y-m-d H:i:s", $timestamp);

        if (!$model->save()) {
            if (isset($model->errors['doctor_id'])) {
                $this->addError('time', 'Невозможно записаться на это время.');
            }
            return false;
        }

        $doctor = Doctor::findOne($this->doctor_id);

        Yii::$app->session->setFlash('info',
            "Вы записались на прием. Доктор: {$doctor->fio}. Время: {$model->started_at}.");

        return true;
    }
}
