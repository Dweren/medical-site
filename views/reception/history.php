<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'История записей');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'doctor_id',
                'value' => 'doctor.fio',
            ],
            [
                'attribute' => 'position',
                'value' => 'doctor.position',
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
            'started_at',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
