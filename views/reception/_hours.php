<?
$doctor = \app\models\Doctor::findOne($model->doctor_id) or \app\models\Doctor::find()->one();
$params = [
    'options' => $doctor->occupiedHoursFormatted($model->date)
];
echo $form->field($model, 'time')->dropDownList(app\models\Doctor::workingHours(), $params)->label('Время');
