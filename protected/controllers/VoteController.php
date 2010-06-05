<?php

class VoteController extends Controller
{
	const PAGE_SIZE=20;
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	public $is_me;

	public function actionIndex()
	{
		$uid = Yii::app()->user->id;
		$model = new Vote();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->select = "friend.fuid as uid,t.*";
		$criteria->order='id';
		$criteria->join = "left join friend on friend.fuid = t.uid ";
		$criteria->condition="friend.uid=:uid";
		$criteria->params=array(':uid'=>$uid);

		$gid = Yii::app()->request->getQuery('gid');
		if(!empty($gid))
		{
			$criteria->join .= " left join friend_belong_group on friend_belong_group.uid = friend.uid ";
			$criteria->addCondition('gid='.$gid);
		}

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$mini_list = $model->findAll($criteria);

		$data = array(
			'mini_list'=> $mini_list,
			'pages'=> $pages,
		);


		$this->render('index',$data);
	}

	/**
	 * 我的投票
	 */
	public function actionMy()
	{
		$uid = Yii::app()->user->id;

		$model = new Vote();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>$uid);

		$mini = $model->find($criteria);

		$icon_list = Smile::model()->findAll();

		$date = Yii::app()->request->getQuery('date');
		if(!empty($date))
		{
			$criteria = $model->fileaway($date,$criteria);
		}

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$list = $model->findAll($criteria);

		$data = array(
			'list'=> $list,
			'pages'=> $pages,
			'mini'=> $mini,
			'icon_list' =>$icon_list,
		);

		$this->render('my',$data);
	}

	/**
	 * 我的投票
	 */
	public function actionAll()
	{
		$uid = Yii::app()->user->id;

		$model = new Vote();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$date = Yii::app()->request->getQuery('date');
		if(!empty($date))
		{
			$criteria = $model->fileaway($date,$criteria);
		}

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$mini_list = $model->findAll($criteria);

		$data = array(
			'mini_list'=> $mini_list,
			'pages'=> $pages,
		);

		$this->render('my',$data);
	}

	/**
	 * 好友的投票
	 */
	public function actionFriends()
	{
		$uid = Yii::app()->request->getQuery('uid');
		$mid = Yii::app()->user->id;

		if($uid == $mid)
		{
			$this->redirect(array('my'));
		}

		$model = new Vote();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>$uid);

		$date = Yii::app()->request->getQuery('date');
		if(!empty($date))
		{
			$year = $date[0].$date[1].$date[2].$date[3];
			$month = $date[4].$date[5];
			$start = mktime(0,0,0,$month,1,$year);
			$end   = mktime(0,0,0,$month+1,1,$year);
			$condition = "$start < ctime AND ctime < $end";
			$criteria->addCondition($condition);
		}

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$mini_list = $model->findAll($criteria);

		$data = array(
			'mini_list'=> $mini_list,
			'pages'=> $pages,
		);


		$this->render('my',$data);
	}
	
	public function actionShow()
	{
		$id = Yii::app()->request->getQuery('id');
		$mid = Yii::app()->user->id;
		$model = new Vote();
		$vote = $this->loadModel($id);

		
		//验证是否投过票
		//$hasvoted = $this->_checkPollHasVote($this->uid,$pid);
		$info = $vote->getVoteInfo();

		
		
		$data = array(
			'vote'=> $vote,
			'info'=> $info,
			'mid'=>$mid,
			'vote_log'=>$vote_log
		);
		
		$this->render('show',$data);
	}

	public function actionCreate()
	{
		$model = new Vote();
		
		if(!empty($_POST['test']))
		{


		}
		$data = array(
			'vote'=> $vote,
			'mid'=>$mid,
		);
		
		$this->render('create',$data);
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Vote::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}	
}
