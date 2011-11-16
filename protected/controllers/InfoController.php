<?php

class InfoController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new User();
		$uid = Yii::app()->user->id;
		$form = $model->findByPk($uid);
		$form->scenario = 'base';
		$data = array(
			'model' => $form,
		);
		$this->render('index',$data);
	}
	
	public function actionIntro()
	{
		$form=new User();
		$data = array(
			'model' => $form,
		);
		$this->render('intro',$data);
	}
	
	public function actionContact()
	{
		$form=new User();
		$data = array(
			'model' => $form,
		);
		$this->render('contact',$data);
	}

	public function actionEducation()
	{
		$form=new User();
		$data = array(
			'model' => $form,
		);
		$this->render('education',$data);
	}
	
	public function actionCareer()
	{
		$form=new User();
		$data = array(
			'model' => $form,
		);
		$this->render('career',$data);
	}

	public function actionFace()
	{
	
		$form=new User();
		$data = array(
			'model' => $form,
		);
		$this->render('face',$data);
	}
}
