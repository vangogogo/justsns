<?php

class InfoController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$data = array(
			'form' => $form,
		);
		$this->render('index',$data);
	}
	
	public function actioIntro()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('intro',$data);
	}
	
	public function actionContact()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('contact',$data);
	}

	public function actionEducation()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('education',$data);
	}
	
	public function actionCareer()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('career',$data);
	}

	public function actionFace()
	{
		$form=new user();
		$data = array(
			'form' => $form,
		);
		$this->render('face',$data);
	}	
}
