<?php
namespace app\models;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use Yii;

class RegistrationForm extends BaseRegistrationForm
{
    public $birthday;

    public function rules()
    {
        $user = $this->module->modelMap['User'];

        return [
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernamePattern'  => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required'],
            'birthdayRequired' => ['birthday', 'required'],
            'usernameUnique'   => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'This username has already been taken')
            ],
            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'This email address has already been taken')
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 72],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'    => Yii::t('user', 'Email'),
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'birthday'      => 'Birthday',
        ];
    }
}
