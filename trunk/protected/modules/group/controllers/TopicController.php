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
		//$friend_list = $owner->getUserFriends($uid);

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
	 public function actionView()
	{
		$topic = $this->loadTopic();
		$comment=$this->newComment($post);

		//不存在则提示..访问内容不存在.
		$data = array(
			'topic'=>$topic,
		);
		$this->render('view',$data);
	}

	/**
	 * 读取话题
	 */
	public function loadTopic()
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

	/**
	 * 增加话题回复
	 */
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
}
