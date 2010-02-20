<?php

class MiniController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$uid = Yii::app()->request->getParam('uid');
		//用户信息
		$owner = user::model()->with(array('mini'))->findByPk($uid);
		
		//8个应用
		$apps = App::model()->findAll();

		//应用的计数
		//$apps_num = $this->api->space_getCount($this->uid);
		$apps_num = array();
		
		//是否自己的空间
		$mid = Yii::app()->user->id;
		if($uid == $mid)
		{
			$is_me = true;
		}
		
		$may_users = array();
		
		//空间主人的好友
		$friend_list = $this->getUserFriends($uid);
		
		
		
		$data = array(
			'owner'=>$owner,
			'is_me'=>$is_me,
			'apps'=>$apps,
			'apps_num'=>$apps_num,
		
			'uid' => $uid,
			'mid' => $mid,
			'may_users' => $may_users,
			'visitors' => $visitors,
			'friend_list' => $friend_list,
		);
		$this->render('index',$data);
	}
	
	private function getUserFriends($uid) {
		$friends = array();
		
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
				$fri_user = $value->user;
				if(!empty($fri_user))
					$friends[$key] = $fri_user->getUserInfo();
			}
		}
		return $friends;
	}	
}
