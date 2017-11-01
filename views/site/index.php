<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <p class="lead">Добро пожаловать на сайт нашей клиники!</p>

        <? if (Yii::$app->user->isGuest) { ?>

        <p>Для записи на прием к доктору Вам сначала необходимо <?= Html::a('войти', ['/user/security/login']) ?><a href=""></a> в свой личный кабинет.</p>

        <? }else{ ?>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Записаться на прием</a></p>

        <? } ?>

    </div>
</div>
