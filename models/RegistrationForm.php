<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.05.2019
 * Time: 12:26
 */

namespace app\models;


use yii\base\Model;


class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['confirmPassword', 'required'],
            ['confirmPassword', 'string', 'min' => 6],
            ['confirmPassword', 'confirm'],

            ['verifyCode', 'captcha'],
        ];
    }

    public function confirm()
    {
        if ($this->password === $this->confirmPassword)
            return;

        $this->addError('confirmPassword', 'Пароль не совподають.');
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}

