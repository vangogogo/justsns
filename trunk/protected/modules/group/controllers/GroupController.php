<?php

class GroupController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		//空间主人的好友
		$friend_list = $owner->getUserFriends($uid);

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

	/**
	 * 我的小组
	 */
	 public function actionMy()
	{
		$uid = Yii::app()->user->id;

		$model =  new GroupMember();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid AND status = 1";
		$criteria->params=array(':uid'=>$uid);
		
		$group_list = $model->findAll($criteria);

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
		$this->render('my',$data);	
	}

}
