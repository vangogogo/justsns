<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangeEmail extends CFormModel {
	public $newEmail;
	public $verifyEmail;
	
	public function rules() {
		return array(
			array('newEmail, verifyEmail', 'required'),
			array('newEmail, verifyEmail', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('verifyEmail', 'compare', 'compareAttribute'=>'newEmail', 'message' => UserModule::t("Retype Password is incorrect.")),
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
		);
	}
} 
