<?php

class GiftController extends Controller
{
	public $defaultAction='send';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSend()
	{
		$this->render('send');
	}	
}