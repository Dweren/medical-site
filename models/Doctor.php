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

    /**
     * @inheritdoc
     */
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
}
