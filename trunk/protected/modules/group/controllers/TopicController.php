<?php

class TopicController extends Controller
{
	private $_model;
	public $defaultAction = 'show';
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
		$gid = Yii::app()->request->getQuery('gid');
		$model =  new Group();
		$group = $model->loadGroup($gid);
		
		$model = new GroupTopic();
		$model->scenario = 'create';

		
		if(!empty($_POST['GroupTopic']))
		{
			$attributes = $_POST['GroupTopic'];
			$model = $group->addTopic($attributes);
			if(empty($topic->errors))
			{
				$this->redirect(array('show','tid'=>$model->id));
			}
			//$model->validate();
		}
		
		$data = array(
			'form'=>$model,
		);
		$this->render('create',$data);
	}

	/**
	 * 编辑话题
	 */
	public function actionEdit()
	{
		$model = new GroupTopic();
		$tid = Yii::app()->request->getQuery('tid');
		$model = $model->loadTopic($tid);
		$group = $topic->group;
		
		if(!empty($_POST['GroupTopic']))
		{
			$attributes = $_POST['GroupTopic'];
			$topic = $model->addTopic($attributes);
			if(empty($topic->errors))
			{
				$this->redirect(array('show','tid'=>$model->id));
			}
			//$model->validate();
		}
		
		$data = array(
			'form'=>$model,
		);
		$this->render('create',$data);
	}
		
	/**
	 * 话题内容
	 */
	 public function actionShow()
	{
		$model = new GroupTopic();
		$tid = Yii::app()->request->getQuery('tid');
		$topic = $model->loadTopic($tid);

		//访问量+1
		$topic->updateCounters(array('viewcount'=>+1));
		//相关话题求助
		$group = $topic->group;
		$topics = $group->getGroupNewThreads();
		
		$params = array('tid'=>$tid,'pageSize'=>20);

		$params['page'] = $_GET['page'];
		$post_data = $group->getGroupPosts($params);

		$GroupPost = new GroupPost();
		$GroupPost->gid = $topic->gid;
		$GroupPost->tid = $topic->id;
		
		//不存在则提示..访问内容不存在.
		$data = array(
			'topic'=>$topic,
			'GroupPost'=>$GroupPost,
			'post_list'=>$post_data['post_list'],
			'post_pages'=>$post_data['post_pages'],
		);
		$this->render('topic',$data);
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
	
	/**
	 * 修改话题的状态，置顶，精华，锁定
	 */
	public function actionSwitch() 
	{
		$model = new GroupTopic();
		$tid = Yii::app()->request->getQuery('tid');
		$topic = $model->loadTopic($tid);

		$option = empty($_GET['option'])?0:$_GET['option'];
		$value = empty($_GET['value'])?0:1;

		if(!in_array($option, array('dist','top','lock'))) {
			throw new CHttpException(404,'非法选项.');
		}
		$topic->$option = $value;
		$topic->save();
		echo !empty($topic->errors)?-1:1;
	}

	public function actionDoDelTopic()
	{
		echo 'actionDoDelTopic';
	}
	
	public function actionDoDelPost()
	{
		echo 'actionDoDelTopic';
	}
	
	public function actionDoAddPost()
	{
		$model = new GroupPost();
		$params = $_POST['GroupPost'];
		$post = $model->addPost($params);
		echo !empty($topic->errors)?-1:1;
	}
}
