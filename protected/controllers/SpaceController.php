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

		$uid = Yii::app()->request->getParam('uid');
		$mid = Yii::app()->user->id;
		
		$may_users = $u_fris = array();
		
		$model = new Friend();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->condition="t.uid=:uid";
		$criteria->params=array(':uid'=>$uid);
		$criteria->limit = 9;
		//获取数据集
		$friend_list = $model->with('user')->findAll($criteria);
		//好友信息,获取好友记录等等
		$friends = array();
		if(!empty($friend_list))
		{
			foreach($friend_list as $key => $value)
			{
				$user = $value->user;
				if(!empty($user))
					$friends[$key] = $user->getUserInfo();
			}
		}
		
		$data = array(
			'form' => $form,
			'uid' => $uid,
			'mid' => $mid,
			'may_users' => $may_users,
			'friend_list' => $friends
		);
		$this->render('index',$data);
	}
}
