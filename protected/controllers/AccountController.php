<?php

class AccountController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actionAccount()
	{

		$this->render('account');
	}
		
	public function actionSecurity()
	{
		$model = new LoginRecord();
		$criteria = new CDbCriteria;
		$criteria->limit = 2;
		$criteria->order = 'login_time DESC';
		$criteria->conditions = 'uid = :uid';
		$criteria->params = array(':uid'=>Yii::app()->user->id);

        $pLoginRecord = $model->findAll($criteria);

		$data = array(
			//上次登陆
		    'lastLoginInfo' => $pLoginRecord[1],
			//本次登陆
		    'thisLoginInfo' => $pLoginRecord[0],	
		);
		$this->render('security',$data);

	}
}
