<?php

class TopicController extends Controller
{
	private $_model;
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model = new GroupTopic();
		
		$id = Yii::app()->request->getQuery('id');
		$topic = $model->findByPk($model);
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
	 * 新增话题
	 */
	public function actionCreate()
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
		$this->render('create',$data);
	}

	/**
	 * 话题内容
	 */
	 public function actionShow()
	{
		$topic = $this->loadModel();

		//不存在则提示..访问内容不存在.
		

		$data = array(
			'topic'=>$topic,
		);

		$this->render('show',$data);
	}

	/**
	 * 读取话题
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$condition='status=1';
				$this->_model=GroupTopic::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'访问内容不存在.');
		}
		return $this->_model;
	}
}
