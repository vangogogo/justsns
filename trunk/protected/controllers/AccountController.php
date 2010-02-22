<?php

class AccountController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$form=new user();
		$form->scenario = 'modify';
		if(!empty($_POST['user']))
		{
			$attributes = $_POST['user'];
			$form->attributes = $attributes;
			$form->validate();

			$uid = Yii::app()->user->id;
			$user = user::model()->findByPk($uid);
			if(md5($attributes['oldpassword']) != $user->password)
			{
				$form->addError('oldpassword', '旧密码错误');
			}
			else 
			{
				$user->password = $attributes['password'];
				$user->save();
				$this->refresh();
				//弹出提示框
			}			
		}
		$data = array(
			'form' => $form,
		);
		$this->render('index',$data);
	}

	public function actionAccount()
	{
		$form=new user();
		$form->scenario = 'account';
		if(!empty($_POST['user']))
		{
			$attributes = $_POST['user'];
			$form->attributes = $attributes;
			$form->validate();
			
		}
		$data = array(
			'form' => $form,
		);
		$this->render('account',$data);
	}
		
	public function actionSecurity()
	{
		$model = new LoginRecord();
		$criteria = new CDbCriteria;
		$criteria->limit = 2;
		$criteria->order = 'login_time DESC';
		$criteria->conditions = 'uid = :uid';
		$criteria->params = array(':uid'=>Yii::app()->user->id);

        $pLoginRecord = $model->findAll($criteria);

		$data = array(
			//上次登陆
		    'lastLoginInfo' => $pLoginRecord[1],
			//本次登陆
		    'thisLoginInfo' => $pLoginRecord[0],	
		);
		$this->render('security',$data);
	}
	
	public function actionScore()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('score',$data);
	}

	public function actionFaq()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('faq',$data);
	}
}
