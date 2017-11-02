<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reception */
/* @var $form yii\widgets\ActiveForm */



$doctor = \app\models\Doctor::findOne($model->doctor_id) or \app\models\Doctor::find()->one();
$params = [
    'options' => $doctor->occupiedHoursFormatted($model->date)
];

?>

<div class="reception-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Doctor::find()->all(), 'id', 'fio')) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('Дата') ?>

    <?= $form->field($model, 'time')->dropDownList(app\models\Doctor::workingHours(), $params)->label('Время'); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
