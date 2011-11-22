<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends UserLogin
{
	public $username;
	public $password;
	public $rememberMe;
	public $verifyCode;
	public $email;

	private $_identity;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			#array('email, password', 'required'),
			//验证码
			//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			// password needs to be authenticated
			array('password', 'authenticate'),
			array('rememberMe', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode' => '验证码',
			'userid' => 'Userid',
			'username' => '用户名',
			'password' => '密　码',
			'email' => '邮　箱',
			'profile' => '用户信息',
			'rememberMe'=>'下次自动登录(保持30天)',
		);
	}



	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

}
