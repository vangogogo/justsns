<?php

class GroupController extends Controller
{
	private $_model;
	const THREAD_PAGE_SIZE=6;
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'groupAdmin + update,members', // Apply this filter only for the update action.
			#'groupMemeber + update,members', // Apply this filter only for the update action.
			'rights',
		);
	}
	
	/**
	 * Filter method for checking whether the currently logged in user
	 * is the author of the post being accessed.
	 */
	public function filterGroupAdmin($filterChain)
	{
		$group=$this->loadModel();
		// Remove the 'rights' filter if the user is updating an own post
		// and has the permission to do so.
		if(Yii::app()->user->checkAccess('小组创建者', array('uid'=>$group->uid)) OR Yii::app()->user->checkAccess('小组管理员', array('gid'=>$group->primaryKey)))
			$filterChain->removeAt(1);
			
		$filterChain->run();
	}
	
	/**
	* Actions that are always allowed.
	*/
	public function allowedActions()
	{
	 	return 'index,show, suggestTags,discussion';
	}

	
	/**
	 * 小组列表页
	 */
	public function actionIndex()
	{
		$model = new Group();
		$params = array('pageSize'=>1);		
		$new_groups =$model->getNewGroups($params);
		$groups_count = 0;
		$d = $model->getGroupThreads(array(),12);
		$threads = $d['threads'];
		$pages = $d['pages'];
		$data = array(
			'new_groups'=>$new_groups,
			'groups_count'=>$groups_count,
			'threads'=>$threads,
			'pages'=>$pages,
		);
		$this->render('index',$data);
	}
	
	/**
	 * 小组首页,到了某个小组
	 */
	public function actionShow()
	{
		$gid = Yii::app()->request->getQuery('gid');
		$model =  new Group();
		$group = $model->loadGroup($gid);
		//友情小租
		//$friend_groups = $group->getGroupNewFriends();
		//最近加入
		$group_members = $group->getGroupNewMembers();
		



		//话题
		$params = array('pageSize'=>self::THREAD_PAGE_SIZE,'page'=>Yii::app()->request->getParam('page'));
		$d =$model->getGroupThreads($params);

		$threads = $d['threads'];
		$pages = $d['pages'];
        $page_count = $pages->getPageSize();

		$adminList = array();
		$memberList = array();
		
		$data = array(
			'group'=>$group,
			'threads'=>$threads,
			'adminList'=>$adminList,
			'memberList'=>$memberList,
			'pages'=>$pages,
			'page_count'=>$page_count,
		);
		$this->render('show',$data);
	}

	/**
	 * 小组列表页
	 */
	public function actionList()
	{
		$model = new Group();
		$page = Yii::app()->request->getParam('page');
		$params = array('pageSize'=>20,'page'=>$page);
		$data = $model->getGroups($params);

		$this->render('list',$data);
	}

	/**
	 * 小组的所有话题
	 */	
	public function actionDiscussion()
	{
		$model = new Group();

		$group = $model->loadGroup($_GET['gid']);
		//话题
		$page = Yii::app()->request->getParam('page');
		$params = array('pageSize'=>self::THREAD_PAGE_SIZE,'page'=>$page);
		$data =$model->getGroupThreads($params);
		$data['group'] = $group;
		$this->render('discussion',$data);
	}
	/**
	 * 小组的所有话题
	 */	
	public function actionMembers()
	{
		$model = new Group();
		$group = $model->loadGroup($_GET['gid']);
		//话题
		$params = array('pageSize'=>self::THREAD_PAGE_SIZE,'page'=>$_GET['page']);
		$data =$group->getGroupMembers($params);
		$data['group'] = $group;
		$this->render('members',$data);
	}
	/**
	 * 创建小组
	 */
	 public function actionCreate()
	{
		$uid = Yii::app()->user->id;
		
		$model = new Group();
		$model->scenario = 'create';
		$category_list = $model->getGroupCategory();
		$category_list = CHtml::listData($category_list,'id','title');
		
		if(!empty($_POST['Group']))
		{
			$attributes = $_POST['Group'];
			$model->attributes = $attributes;
			$model->validate();
		}
		
		$data = array(
			'owner'=>$owner,
			'is_me'=>$is_me,
			'group'=>$group,
			'category_list'=>$category_list,
		);
		$this->render('create',$data);	
	}
	 public function actionUpdate()
	{
		$uid = Yii::app()->user->id;
		
		$model = new Group();
		$group = $model->loadGroup($_GET['gid']);

        $this->performAjaxValidation($group);

		$category_list = $model->getGroupCategory();
		$category_list = CHtml::listData($category_list,'id','title');
		
		if(!empty($_POST['Group']))
		{
			$attributes = $_POST['Group'];
			$group->attributes = $attributes;
			$group->save();
		}
		
		$data = array(
			'owner'=>$owner,
			'is_me'=>$is_me,
			'group'=>$group,
			'category_list'=>$category_list,
		);
		$this->render('update',$data);	
	}	
	public function actionGetGroupCategory()
	{
		$model = new Group();
		$params = $_POST['params'];
		$exam = $model->getGroupCategory($params);
	}
	
	public function actionMyTopic()
	{
		$params = array(
			'uid'=>Yii::app()->user->id,
		);
		$model = new Group();
		$data = $model->getGroupThreads($params,20);
		$this->render('MyTopic',$data);	
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['gid']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Group::model()->findByPk($_GET['gid'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
}
