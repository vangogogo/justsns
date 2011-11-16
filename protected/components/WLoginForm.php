<?php

class WLoginForm extends Portlet
{
	protected function renderContent()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;

			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo UActiveForm::validate(array($model));
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl=='/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('WLoginForm',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}

}
