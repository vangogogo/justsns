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
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if (strpos($this->username,"@")) {
			$user=User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		}
		if($user===null)
			if (strpos($this->username,"@")) {
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		else if(Yii::app()->getModule('user')->encrypting($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status==0&&Yii::app()->getModule('user')->loginNotActiv==false)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function authenticateUC()
	{

		//通过接口判断登录帐号的正确性，返回值为数组
		list($uid, $username, $password, $email) = uc_user_login($this->username, $this->password);

		setcookie('Example_auth', '', -86400);
		if($uid > 0) {
			//用户登陆成功，设置 Cookie，加密直接用 uc_authcode 函数，用户使用自己的函数
			setcookie('Example_auth', uc_authcode($uid."\t".$username, 'ENCODE'));
			//生成同步登录的代码
			$ucsynlogin = uc_user_synlogin($uid);
				
			$user=User::model()->findByPk($uid);
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

			$this->errorCode=self::ERROR_NONE;
		} elseif($uid == -1) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} elseif($uid == -2) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
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
