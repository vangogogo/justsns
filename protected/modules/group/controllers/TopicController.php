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
		//相关话题求助
		$group = $topic->group;
		$topics = $group->getGroupNewThreads();
		//默认回复
		$GroupPost = $this->addPost();
		$GroupPost->gid = $topic->gid;
		$GroupPost->tid = $topic->id;
		
		$params = array('tid'=>$tid,'pageSize'=>20,'is_del'=>0);

		$params['page'] = $_GET['page'];
		$post_data = $group->getGroupPosts($params);
		$post_list = $post_data['post_list'];
		$post_pages = $post_data['post_pages'];

		//最后一页才能回复
		if(empty($post_pages) OR ($post_pages->PageCount == $post_pages->CurrentPage + 1))
		{
			$post_access = 1;
		}

		
		//访问量+1
		$topic->updateCounters(array('viewcount'=>+1));
		
		//不存在则提示..访问内容不存在.
		$data = array(
			'topic'=>$topic,
			'GroupPost'=>$GroupPost,
			'post_list'=>$post_list,
			'post_pages'=>$post_pages,
			'post_access'=>$post_access,
		);
		$this->render('topic',$data);
	}
	/**
	 * 增加话题回复
	 */
	protected function addPost()
	{
		$model = new GroupPost();
		$params = $_POST['GroupPost'];
		if(!empty($params))
		{
			$post = $model->addPost($params);
			if(empty($post->errors))
			{
//				$this->refresh();
				$this->refresh(true,'&post=ok#last');
			}
			else
			return $post;
		}
		return $model;
	}
	
	/**
	 * 修改话题的状态，置顶，精华，锁定
	 */
	public function actionDoSwitch() 
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

	/**
	 * 异步删除话题
	 */
	public function actionDoDelTopic()
	{
		$id = $_GET['tid'];
		$model = new GroupTopic();
		$topic = $model->loadTopic($id);
		$return = $topic->delTopic();
		echo $return;
	}
	
	/**
	 * 异步删除回复
	 */
	public function actionDoDelPost()
	{
		$id = $_GET['pid'];
		$model = new GroupPost();
		$post = $model->loadPost($id);
		$return = $post->delPost();
		echo !$return?-1:1;
	}
	
	/**
	 * 异步添加回复
	 */
	public function actionDoAddPost()
	{
		$model = new GroupPost();
		$params = $_POST['GroupPost'];
		$post = $model->addPost($params);
		echo !empty($topic->errors)?-1:1;
	}
}
