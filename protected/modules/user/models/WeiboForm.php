<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class WeiboForm extends User {
	public $verifyPassword;
	
	public function rules() {
		$rules = array(
			array('username, password, verifyPassword', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			#array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
		);
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}

    public function getUserBySinaID($sina_id)
    {
        
        $user=User::model()->notsafe()->findByAttributes(array('sina_id'=>$sina_id));
        return $user;
    }

    public function loginBySina()
    {
		$SAEOAuth = Yii::app()->SAEOAuth;
		$client = $SAEOAuth->getSinaClient();
        $sina_id = $SAEOAuth->getUserID();
        $sina_info = $client->show_user($sina_id);

        $model = new WeiboForm;
        $user = $model->getUserBySinaID($sina_id);
        if(empty($user))
        {
            $username = $sina_id;
            $password = '';

            $model->username = $sina_id;
            $model->password = $password;
            $model->verifyPassword = $password;

		    $soucePassword = $model->password;
		    $model->activkey=UserModule::encrypting(microtime().$model->password);
		    $model->password=UserModule::encrypting($model->password);
		    $model->verifyPassword=UserModule::encrypting($model->verifyPassword);
		    $model->superuser=0;
		    $model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
            $model->sina_id = $sina_id;

            $model->save();
            $user = $model;
        }
        $profile = $user->profile;
        if(empty($profile))
        {
            $profile = new Profile;
            $profile->user_id=$model->id;
        }

        $profile->name = $sina_info['name'];
        $profile->location = $sina_info['location'];
        $profile->current_province = $sina_info['province'];
        $profile->current_city = $sina_info['city'];
        $profile->save();

        $username = $user->username;
        $password = $user->password;
		$identity=new UserIdentity($username,$password);
		$identity->authenticateWeibo();
		//必须设置默认时间，才能多域名共享登录session
		#$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
		Yii::app()->user->login($identity,$duration);
    }
	
}
