<?php

use yii\helpers\Url;

class RegisterCest
{
    public function ensureThatRegistrationWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->click('Регистрация');
        $I->see('Зарегистрироваться', 'h3');

        $I->amGoingTo('try to sign up');
        $I->fillField('input[name="register-form[birthday]"]', '2017-11-02');
        $I->click('#register-form-email');
        $I->fillField('input[name="register-form[email]"]', 'admin@localhost.com');
        $I->fillField('input[name="register-form[username]"]', 'admin');
        $I->fillField('input[name="register-form[password]"]', '123456');
        $I->click('Зарегистрироваться');
        $I->wait(8);

        $I->see('Ваш аккаунт был создан и сообщение с дальнейшими инструкциями отправлено на ваш email');
//        $I->see('Logout');
    }
}