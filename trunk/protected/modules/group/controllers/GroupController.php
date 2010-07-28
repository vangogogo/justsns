<?php

class GroupController extends Controller
{
	private $_model;
	/**
	 * 小组首页
	 */
	public function actionIndex()
	{
		$model = new Group();
		$new_groups =$model->getNewGroups();
		$groups_count = $model->countGroups();
		$d = $model->getGroupThreads(array(),12);
		$threads = $d['threads'];
		$data = array(
			'new_groups'=>$new_groups,
			'groups_count'=>$groups_count,
			'threads'=>$threads,
		);
		$this->render('index',$data);
	}
	
	/**
	 * 小组首页
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
		$threads = $group->getGroupNewThreads();
		$adminList = array();
		$memberList = array();
		
		$data = array(
			'group'=>$group,
			'threads'=>$threads,
			'adminList'=>$adminList,
			'memberList'=>$memberList,
		);
		$this->render('show',$data);
	}
	/*
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
	public function actionGetGroupCategory()
	{
		$model = new Group();
		$params = $_POST['params'];
		$exam = $model->getGroupCategory($params);
	}
}
