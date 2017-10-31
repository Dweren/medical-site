<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Doctor */

$this->title = Yii::t('app', 'Create Doctor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
