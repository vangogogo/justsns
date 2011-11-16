<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $menu=array();
	public $breadcrumbs=array();
    public $layout='//layouts/column1';

	public $mid = 0;
	public $uid = 0;

	public function init()
	{
		$this->mid = Yii::app()->user->id;
		$this->uid = Yii::app()->request->getQuery('uid');
		
		defined('PUBLIC_URL') or define('PUBLIC_URL',Yii::app()->request->baseUrl.'/');
		defined('THEME_URL') or define('THEME_URL',Yii::app()->theme->baseUrl.'/');
		/*
		if(!Yii::app()->user->isGuest)
		{
			$this->layout='application.views.layouts.column2';
		}
		else
		{
			$this->layout='application.views.layouts.column1';
		}
		$this->layout='application.views.layouts.column1';
        */
	}

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
		);
	}

	/**
	 * @var string $message 显示内容
	 * @var array $url 路由
	 * @var int $delay 跳转时间
	 * @var $type 显示样式
	 * 所有Controller的重定向跳转
	 */
	public function redirectMessage($message, $url = array('/'), $delay=3, $type = 'success' , $script='')
	{
		//$this->layout=false;
		if(is_array($url))
		{
			$route=isset($url[0]) ? $url[0] : '';
			$url=$this->createUrl($route,array_splice($url,1));
		}
		$this->render('/redirect', array(
			'message' => $message,
			'url' => $url,
			'delay' => $delay,
			'script' => $script,
			'type' => $type,
		));
		exit;
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
