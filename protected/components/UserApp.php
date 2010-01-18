<?php

Yii::import('zii.widgets.CPortlet');

class UserApp extends CPortlet
{

	protected function renderContent()
	{
		$this->render('userApp');
	}
}
