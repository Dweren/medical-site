<?php

use yii\helpers\Url;

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->click('Вход');
        $I->see('Логин', 'label');

        $I->amGoingTo('try to login with incorrect credentials');
        $I->fillField('input[name="login-form[login]"]', 'admin');
        $I->fillField('input[name="login-form[password]"]', 'admin');
        $I->click('Авторизоваться');
        $I->wait(2); // wait for button to be clicked

        $I->expectTo('Неправильный логин или пароль');
//        $I->see('Logout');
    }
}