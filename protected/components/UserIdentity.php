<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public $email;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//$user=user::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		$user=user::model()->find('LOWER(email)=?',array(strtolower($this->username)));
		if($user===null)
			//$this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(md5($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;

			$this->setState('email', $user->email);

			//$this->setState('role', '管理员');
			//保存登录记录

			$arr = array(
				'uid' => $user->id,
				'login_time' => strtotime('NOW'),
				'login_ip' => Yii::app()->request->userHostAddress,
			);
			$model = new LoginRecord();
			$model->attributes = $arr;
			$model->save();
			//LoginRecord::model()->saveAttributes($arr);

            $this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
