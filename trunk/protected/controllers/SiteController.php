<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionReg()
	{
		$form=new user();
		$form->scenario = 'reg';
		if(isset($_POST['user']))
		{
			
			$form->attributes=$_POST['user'];
			if($form->save())
			{
				//注册完自动登录
				$LoginForm=new LoginForm;
				$LoginForm->attributes= array(
					'username' => $form->username,
					'password' => $_POST['user']['password'],
				);
				if($LoginForm->validate())
					$this->redirect(Yii::app()->user->returnUrl);
				else
				{
					$this->redirect('/site/login');
				}
			}
		}

		$data = array(
			'form'=>$form,
			'reg_verify_allow' => 1,	
		);
		// display the login form
		$this->render('reg',$data);
	}
	//用户名检查
	public function actioncheckUsername()
	{
	
		if(Yii::app()->request->isAjaxRequest OR 1) {
			if(isset($_GET['user'])) {
				$form=new user();
				$form->scenario = 'reg';
				$form->setAttributes($_GET['user'],false);
				
				echo CJavaScript::jsonEncode($form->checkUsername());
			}
		}
	}
	//Email检查
	public function actioncheckEmail()
	{
	
		if(Yii::app()->request->isAjaxRequest OR 1) {
			if(isset($_GET['user'])) {
				$form=new user();
				$form->scenario = 'reg';
				$form->setAttributes($_GET['user'],false);
				
				echo CJavaScript::jsonEncode($form->checkEmail());
			}
		}
	}
		//获取地区显示页面
	public function actionGetArea()
	{
		/*
		$list = $this->api->Network_getList();;
		$arrPid = explode(',',$_POST['pid']);
		$level  = $_POST['level'];

		if($level=='init'){
			$this->assign('arealevel',intval($_POST['arealevel']));
			$this->assign('init','1');
			$this->assign('arrPid',$arrPid);
		}else{
			if(is_array($arrPid)){
				unset($arrPid[0]);
				foreach ($arrPid as $v){
					if($list[$v]['child']){
						$list = $list[$v]['child'];
					}
				}
			}
		}
		*/
		$list = array();
		$init = $arealevel = '0';
		
		
		
		$pid = Yii::app()->request->getParam('pid');

		$list = area::model()->getlist();

		$arrPid = explode(',',$pid);

		$level  =  Yii::app()->request->getParam('level');
		$arealevel  = $level+1;

		$data = array(
			'list' => $list,
			'arrPid' => $arrPid,
			'arealevel' => $arealevel,
		);

		
		if (Yii::app()->request->isAjaxRequest){

			$this->renderPartial('area',$data,'',TRUE,TRUE);
		}
		else
			$this->render('area',$data);
	}
		
}
