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
		
		//前台 、 后台
		if(!Yii::app()->user->isGuest)
		{
			$this->layout='//layouts/column2';
		}
		else
		{
			$this->layout='//layouts/column1';
		}

        
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

	public function render($view,$data=null,$return=false)
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			parent::renderPartial($view,$data,$return,true);
		}
		else
		{
			parent::render($view,$data,$return);
		}
		exit;

	}
	/*
	* 使用 bootstrap 的样式
	*/
	public function createWidget($className,$properties=array())
	{
		if($className == 'zii.widgets.grid.CGridView')
		{
			$className = 'ext.bootstrap.widgets.grid.BootGridView';
		}
		if($className == 'CActiveForm')
		{
			$className = 'ext.bootstrap.widgets.BootActiveForm';
		}
		if($className == 'zii.widgets.CDetailView')
		{
			$className = 'ext.bootstrap.widgets.BootDetailView';
		}

		$widget=Yii::app()->getWidgetFactory()->createWidget($this,$className,$properties);
		$widget->init();
		return $widget;
	}
}
