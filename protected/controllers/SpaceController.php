<?php

class SpaceController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$uid = Yii::app()->request->getParam('uid');
		//用户信息
		$owner = User::model()->findByPk($uid);
		
		//8个应用
		$apps = App::model()->findAll();

		//应用的计数
		//$apps_num = $this->api->space_getCount($this->uid);
		$apps_num = array();
		
		//是否自己的空间
		$mid = Yii::app()->user->id;
		$is_me = false;
		if($uid == $mid)
		{
			$is_me = true;
		}
		
		$may_users = array();
		
		//空间主人的好友
		$friend_list = $owner->getUserFriends($uid);
		$visitors  = array();
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

    public function actionMine()
    {
        $uid = Yii::app()->user->id;
        $this->redirect(array('index','uid'=>$uid));
    }
}
