<?php

class GroupController extends Controller
{
	private $_model;

	public $defaultAction = 'my';
	/**
	 * 小组首页
	 */
	public function actionIndex()
	{
		echo "index";
		$this->render('index',$data);
	}
	
	/**
	 * 小组首页
	 */
	public function actionView()
	{
		$id = Yii::app()->request->getQuery('id');
		$model =  new Group();
		$group = $this->loadGroup();
		
		$data = array(
			'group'=>$group,	
		);
		$this->render('view',$data);
	}

	/**
	 * 读取小组
	 */
	public function loadGroup()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$condition='status=1';
				$this->_model=Group::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'访问内容不存在.');
		}
		return $this->_model;
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
