<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id
 * @property string $fio
 * @property string $position
 *
 * @property Reception[] $receptions
 */
class Doctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors';
    }

    public function rules()
    {
        return [
            [['fio', 'position'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'Fio'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptions()
    {
        return $this->hasMany(Reception::className(), ['doctor_id' => 'id']);
    }

    public static function workingHours()
    {
        return [
            '09:00' => '09:00',
            '09:30' => '09:30',
            '10:00' => '10:00',
            '10:30' => '10:30',
            '11:00' => '11:00',
            '11:30' => '11:30',
            '12:00' => '12:00 (Обед)',
            '12:30' => '12:30 (Обед)',
            '13:00' => '13:00',
            '13:30' => '13:30',
            '14:00' => '14:00',
            '14:30' => '14:30',
            '15:00' => '15:00',
            '15:30' => '15:30',
            '16:00' => '16:00',
            '16:30' => '16:30',
            '17:00' => '17:00',
            '17:30' => '17:30',
        ];
    }

    public function occupiedHoursFormatted($date)
    {
        $res = [
            '12:00' => ['disabled' => true],
            '12:30' => ['disabled' => true],
        ];

        $data = $this->getReceptions()->
        where([
            'between',
            'started_at',
            date('Y-m-d 00:00:00', strtotime($date)),
            date('Y-m-d 23:59:59', strtotime($date))
        ])->
        select(["DATE_FORMAT(started_at,'%H:%i') AS niceTime"])->asArray()->all();

        foreach ($data as $row) {
            $res[$row['niceTime']] = ['disabled' => true];
        }

        return $res;
    }

}
