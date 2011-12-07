<?php

class SiteController extends Controller
{
	const PAGE_SIZE=10;

	public $defaultAction='index';

	private $_model;
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(

			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('login'),
				'users'=>array('*'),
			),

			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
		
	public function actionIndex()
	{
		$this->render('index');
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$contact=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$contact->attributes=$_POST['ContactForm'];
			if($contact->validate())
			{
				$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				mail(Yii::app()->params['adminEmail'],$contact->subject,$contact->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('contact'=>$contact));
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
	 * Logout the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionWebsite()
	{
		$model = new MagazineWebsite();
		$rs = $model->getWebsiteSetting();

		if(!empty($_POST))
		{
			foreach($_POST as $name => $value)
			{
				$row = $model->setWebsite($name,$value);
			}
			$model->deleteCache();
			$rs = $model->getWebsiteSetting();
			//Message::ok("系统设置修改成功！<div>后面的参数参看dwz手册</div>");
			//更新网站设置,写文件保存
		}

		$this->render('website',array(
			'rs'=>$rs,
			'model'=>$model,
		));
	}
	
	public function actionFlushCache()
	{
		# code...

		Yii::app()->cache->flush();	
		$url = Yii::app()->request->urlReferrer;

		Yii::app()->user->setFlash('info','缓存已清空！');

		$this->redirect($url);
	}	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			$error['delay'] = 3;
			$error['url'] = $this->getReferUrl();
			$this->layout='column1';
			if(Yii::app()->request->isAjaxRequest)
				$this->renderPartial('error',$error);
				//echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function getReferUrl()
	{
		$refer = Yii::app()->request->getParam('refer');
		if(empty($refer))
		{
			//跨域无法跳转
			//$refer = Yii::app()->user->getReturnUrl();
		}
		if(empty($refer))
		{
			$refer = Yii::app()->request->urlReferrer;
			//如果访问前的地址是首页

		}

		if(empty($refer))
		{
			$refer = Yii::app()->request->baseUrl;
		}
		if(empty($refer))
		{
			$refer = '/';
		}

//		var_dump($refer);
		return $refer;
	}
}
