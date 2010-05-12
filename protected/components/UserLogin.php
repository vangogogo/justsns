<?php

Yii::import('zii.widgets.CPortlet');

class UserLogin extends CPortlet
{
	public $model;
	protected function renderContent()
	{
		$model=$this->model;
		$this->render('WUserLogin',array('model'=>$model));
	}
}
