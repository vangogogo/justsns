<?php

Yii::import('zii.widgets.CPortlet');

class UserApp extends CPortlet
{

	protected function renderContent()
	{
		$apps = App::model()->findAll();
		$data = array(
			'apps' => $apps
		);
		$this->render('userApp',$data);
	}
}
