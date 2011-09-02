<?php

class WeiboController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}


	public function filters()
	{

	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
                'actions'=>array('index','sms','SendTeacherDaySms'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
                'actions'=>array('login'),
			),
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
        $this->checkAuthorize();
		
		$aurl = $SAEOAuth->getAuthorizeURL();
		$this->redirect($aurl);
	}
	/**
	 * Displays the login page
	 */
	public function actionCallback()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
		$SAEOAuth->callback();
        $this->checkAuthorize();
	}
	/**
	 * 检查是否登录weibo
	 */
    public function checkAuthorize()
    {
		$SAEOAuth = Yii::app()->SAEOAuth;
		if($SAEOAuth->checkAuthorize())
		{
            $model = new WeiboForm;
            $model->loginBySina();
			$this->redirect('weibo');
		}
    }
	/**
	 * Displays the login page
	 */
	public function actionWeibo()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
		$client = $SAEOAuth->getSinaClient();

        $sina_id = $SAEOAuth->getUserID();
        $sina_info = $client->show_user($sina_id);
        print_r($sina_info);
		$ms  = $client->home_timeline(); // done
		$this->render('weibo',array('ms'=>$ms));
	}
}
