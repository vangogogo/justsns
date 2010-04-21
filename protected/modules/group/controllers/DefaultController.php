<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionMy()
	{
		echo "fsdfds";
		$this->render('index');	
	}
}