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
            'usernameTrim' => ['username', 'trim'],
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernamePattern' => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required'],
            'usernameUnique' => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'This username has already been taken')
            ],
            // email rules
            'emailTrim' => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'emailUnique' => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'This email address has already been taken')
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
            // birthday rules
            'birthdayRequired' => ['birthday', 'required'],
            ['birthday', 'date', 'format'=>'yyyy-mm-dd'],
            ['birthday', 'validateDate'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('user', 'Email'),
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'birthday' => Yii::t('user', 'День рождения'),
        ];
    }

    public function validateDate()
    {
        if (strtotime($this->birthday) > time()) {
            $this->addError('birthday', '"День рождения не может быть в будущем!"');
        }

        $date_pieces = explode("-", $this->birthday);

        if(($date_pieces[1] > 12 || $date_pieces[1] == '00')) {
            $this->addError('birthday', '"Не верный формат месяца"');
        }

        if(($date_pieces[2] > date("t", mktime(0, 0, 0, $date_pieces[1], 1, $date_pieces[0])) || $date_pieces[2] == '00')) {
            $this->addError('birthday', '"Не верный формат дня"');
        }
    }
}
