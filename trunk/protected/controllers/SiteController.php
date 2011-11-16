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
				'maxLength'=>'4',
				'minLength'=>'4',
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
			'assets'=>array(
				'class'=>'SAEAssetsAction',
			),
		);
	}
	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest)
		{
			$this->redirect(array('site/home'));
		}
		$data = array();
		$this->render('index',$data);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionHome()
	{
		$notify_num = array(0);
		$uid = Yii::app()->user->id;
		//用户信息
		$owner = User::model()->findByPk($uid);
		
		//8个应用
		$apps = App::model()->findAll();

		//应用的计数
		//$apps_num = $this->api->space_getCount($this->uid);
		$apps_num = array();
		
		//是否自己的空间
		$mid = Yii::app()->user->id;
		if($uid == $mid)
		{
			$is_me = true;
		}
		$notify_num = array(
            'notification'=>0,
            'message'=>0,
            'friend'=>0,
            'wall'=>0,
        );
		$may_users = array();
		
		//空间主人的好友
		$friend_list = $owner->getUserFriends($uid);

		$visitors = array();
		$data = array(
			'owner'=>$owner,
			'is_me'=>$is_me,
			'apps'=>$apps,
			'apps_num'=>$apps_num,
		
			'uid' => $uid,
			'mid' => $mid,
			'may_users' => $may_users,
			'visitors' => $visitors,
			'friend_list' => $friend_list,
			'notify_num' => $notify_num,
		);
		$this->render('home',$data);
	}
	
	/**
	 * Feed ajax 读取
	 */
	public function actionFeed()
	{
		$type = Yii::app()->request->getParam('type');
		$uid = Yii::app()->request->getParam('uid');
		
		$feeds = array();
		$model = new Feed();
		$feeds = $model->getFeeds($uid,$type,$page,$opts);
		
		$data = array(
			'feeds'=>$feeds,
		);
		$this->renderPartial('feed',$data,'',false);

	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			$this->layout='column1';
			if(Yii::app()->request->isAjaxRequest)
				$this->renderPartial('error',$error);
				//echo $error['message'];
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
		$form=new User();
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

    protected function performAjaxValidation($model)
    {
       if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
       {
           echo CActiveForm::validate($model);
           Yii::app()->end();
       }
    }
}
