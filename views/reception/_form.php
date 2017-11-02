<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reception */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="reception-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Doctor::find()->all(), 'id', 'fio')) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'onChange' => '$.get(
                "'. Yii::$app->urlManager->createUrl('reception/hours').'",
                {ReceptionForm: {date: $(this).val(), doctor_id: $("#receptionform-doctor_id").val()}}
                , function(data) { $( ".field-receptionform-time" ).html( data ); })',
        ],

    ])->label('Дата'); ?>

    <?= $this->render('_hours', ['model'=>$model, 'form'=>$form]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
