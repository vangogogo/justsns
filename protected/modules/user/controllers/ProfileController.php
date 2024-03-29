<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['Profile']))
		{
			#$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];

			if($model->validate()&&$profile->validate()) {
                $model->save();
				$profile->save();
				$this->refresh();
			} else $profile->validate();
		}

		$this->render('profile',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
                Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$user = $this->loadUser();
		$model = new UserChangePassword;
        $model->scenario = 'changePassword';
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                        //验证旧密码是否正确
                        if(UserModule::encrypting($_POST['UserChangePassword']['currentPassword']) != $new_password->password)
                        {
                            $model->addError('currentPassword','验证错误');
                        }
                        else
                        {
						    $new_password->password = UserModule::encrypting($model->password);
						    $new_password->activkey=UserModule::encrypting(microtime().$model->password);
						    $new_password->save();
						    Yii::app()->user->setFlash('profileMessage',UserModule::t("New password is saved."));
						    $this->redirect(array("/user"));
                        }
					}
			}
			$this->render('ChangePassword',array('model'=>$model));
	    }
	}

	/**
	 * Change password
	 */
	public function actionChangeEmail() {
		$user = $this->loadUser();
		$model = new UserChangePassword;
        $model->scenario = 'changePassword';
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                        //验证旧密码是否正确
                        if(UserModule::encrypting($_POST['UserChangePassword']['currentPassword']) != $new_password->password)
                        {
                            $model->addError('currentPassword','验证错误');
                        }
                        else
                        {
						    $new_password->password = UserModule::encrypting($model->password);
						    $new_password->activkey=UserModule::encrypting(microtime().$model->password);
						    $new_password->save();
						    Yii::app()->user->setFlash('profileMessage',UserModule::t("New password is saved."));
						    $this->redirect(array("/user"));
                        }
					}
			}
			$this->render('ChangeEmail',array('model'=>$model));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
}
