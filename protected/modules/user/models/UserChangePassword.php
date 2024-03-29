<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
    public $currentPassword;
	public $password;
	public $verifyPassword;
	
	public function rules() {
		return array(
			array('password, verifyPassword, ', 'required'),
			array('password, verifyPassword', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
            array('currentPassword','required', 'on' => 'changePassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>UserModule::t("password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
            'currentPassword'=>'当前密码',
		);
	}
} 
