<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Doctors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'fio:ntext',
            'position:ntext',
            [
                'attribute' => 'Запись на приём',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div>'.Html::a('Записаться на приём', ['/reception/create', 'ReceptionForm[doctor_id]'=>$model->id], ['class'=>'btn btn-small btn-success']).'</div>';
                },
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
