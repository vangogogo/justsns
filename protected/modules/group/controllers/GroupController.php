<?php

class GroupController extends Controller
{
	private $_model;
	/**
	 * 小组列表页
	 */
	public function actionIndex()
	{
		$model = new Group();
		$params = array('pageSize'=>1);		
		$new_groups =$model->getNewGroups($params);
		$groups_count = $model->countGroups();
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
		$params = array('pageSize'=>20,'page'=>$_GET['page']);
		$d =$model->getGroupThreads($params);

		$threads = $d['threads'];
		$pages = $d['pages'];
		
		$page_count = $pages->getPageCount();

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
	 * 小组首页,到了某个小组
	 */
	public function actionList()
	{
		$model = new Group();
		$group_list =$model->getNewGroups($params);
		$data = array(
			'group_list'=>$group_list,
		);
		$this->render('list',$data);
	}

	/**
	 * 小组的所有话题
	 */	
	public function actionDiscussion()
	{
		$model = new Group();
		$group = $model->loadGroup($_GET['gid']);
		$data = $group->getGroupThreads();
		$data['group'] = $group;
		$this->render('discussion',$data);
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
			'form'=>$model,
			'category_list'=>$category_list,
		);
		$this->render('create',$data);	
	}
	 public function actionUpdate()
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
			'form'=>$model,
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
}
