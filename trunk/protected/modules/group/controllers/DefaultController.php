<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		echo "fsdfds";
		
		$this->render('index');
	}

	/**
	 * 创建小组
	 */
	 public function actionCreate()
	{
		$uid = Yii::app()->user->id;
		
		$model = new Group();
		$model->scenario = 'modify';
		if(!empty($_POST['Group']))
		{
			$attributes = $_POST['user'];
			$model->attributes = $attributes;
			$model->validate();
		}
		var_dump($model->errors);
		
		$data = array(
			'owner'=>$owner,
			'is_me'=>$is_me,
			'form'=>$model,
		
			'uid' => $uid,
			'mid' => $mid,
			'may_users' => $may_users,
			'visitors' => $visitors,
			'friend_list' => $friend_list,
		);
		$this->render('create',$data);	
	}
}