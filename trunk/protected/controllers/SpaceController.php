<?php

class SpaceController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$form=new user();
		$form->scenario = 'modify';

		$data = array(
			'form' => $form,
		);
		$this->render('index',$data);
	}
}
