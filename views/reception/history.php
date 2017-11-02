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
        'filterModel' => $searchModel,
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
                'label' => 'Должность',
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'visible' => Yii::$app->user->identity->isAdmin ? '1':'0',
            ],
            [
                'attribute' => 'started_at',
                'value' => function ($model) {
                    return date('Y-m-d H:i', strtotime($model->started_at));
                },
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
