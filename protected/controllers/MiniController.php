<?php

class MiniController extends Controller
{
	const PAGE_SIZE=20;

	public $is_me;

	public function actionIndex()
	{
		$uid = Yii::app()->user->id;

		$model = new Mini();
		//初始化
		$criteria=new CDbCriteria;
		$criteria->select = "{{friend}}.fuid as uid,t.*";
		$criteria->order='id';
		$criteria->join = "left join {{friend}} on {{friend}}.fuid = t.uid ";
		$criteria->condition="{{friend}}.uid=:uid";
		$criteria->params=array(':uid'=>$uid);

		$gid = Yii::app()->request->getQuery('gid');
		if(!empty($gid))
		{
			$criteria->join .= " left join {{friend_belong_group}} on {{friend_belong_group}}.uid = {{friend}}.uid ";
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
	 * 我的心情
	 */
	public function actionMy()
	{
		$uid = Yii::app()->user->id;

		$model = new Mini();
		//初始化
		$criteria=new CDbCriteria;
		$criteria->order='t.ctime DESC';
		$criteria->condition="t.uid=:uid AND t.status != -1";
		$criteria->params=array(':uid'=>$uid);

		$mini = $model->find($criteria);

		$smile = new Smile();
		$icon_list = $smile->getIconList();

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
		//$mini_list = $model->with(array('first','last','count'))->findAll($criteria);
		$mini_list = $model->findAll($criteria);

		$data = array(
			'mini_list'=> $mini_list,
			'pages'=> $pages,
			'mini'=> $mini,
			'icon_list' =>$icon_list,
		);

		$this->render('my',$data);
	}

	/**
	 * 我的心情
	 */
	public function actionAll()
	{
		$uid = Yii::app()->user->id;

		$model = new Mini();
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
	 * 好友的心情
	 */
	public function actionFriends()
	{
		$uid = Yii::app()->request->getQuery('uid');
		$mid = Yii::app()->user->id;

		if($uid == $mid)
		{
			$this->redirect(array('my'));
		}

		$model = new Mini();
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

	public function actionDoAddMini(){
		$content = Yii::app()->request->getPost('content');
		if( empty($content) ){
			echo -1;
			return false;
		}
		$model = new Mini();
		//TODO 检测空白输入
		$model->content = $content;
		$add = $model->save();

		if($add){
			echo Smile::model()->replaceContent($content);
		}else{
			echo -1;
		}
	}


	/*
	 * 删除心情
	 */
	public function actionDoDeleteMini()
	{
		$id = Yii::app()->request->getPost('id');

		$model = new Mini();
		$result = $model->deleteMiniById($id);

		if($result)
		{
			echo 1;
		}
		else
		{
			echo -1;
		}
	}

	/**
	 * actionDoAddReply
	 * 添加mini回复到表 comment
	 * @access public
	 * @return void
	 */
	public function actionDoAddReply()
	{
		$more = Yii::app()->request->getPost('more');
		$page = Yii::app()->request->getPost('page');
		$mid = Yii::app()->request->getPost('mid');
		$id = Yii::app()->request->getPost('id');
		$appid = Yii::app()->request->getPost('appid');
		$comment = Yii::app()->request->getPost('content');
		$quietly = Yii::app()->request->getPost('quietly');

		//TODO feed 到某个提醒
		$toUid = Yii::app()->request->getPost('toUid');


		$type = 'mini';
		$params = array(
			'type'=>$type,
			'appid'=>$appid,
			'comment'=>$comment,
			'toId'=>$toId,
			'quietly'=>$quietly,
		);

		$model = new Comment();
		$model = $model->addComment($params);

		if(!empty($model->errors))
		{
			echo -1;
			exit();
		}
		else
		{
			//			$data = $model->attributes;
			//			$data['face']=$model->user->getUserFace();
			//			echo CJSON::encode($data);
			$data['comments'] = array($model);
			$data['id'] = $appid;
			$data['mid'] = $mid;
			$this->renderPartial('reply_div',$data);
		}
	}

	/**
	 * actionDoDeleteReply
	 * 删除回复 权限拥有者(心情发起者,评论者)
	 * @access public
	 * @return void
	 */
	public function actionDoDeleteReply()
	{
		$id = Yii::app()->request->getPost('id');
		$appid = Yii::app()->request->getPost('appid');
		//TODO 心情发起者也有权限
		$model = new Comment();
		$result = $model->deleteCommentById($id);

		if($result)
		{
			echo 1;
		}
		else
		{
			echo -1;
		}
	}



	/**
	 * ajax获得评论(显示全部XX条)
	 */
	public function actionGetReply()
	{
		$uid = Yii::app()->request->getPost('mid');
		$appid = Yii::app()->request->getPost('appid');

		$type = 'mini';

		$params = array(
			'type'=>$type,
			'appid'=>$appid,
			'uid'=>$uid,
		);
		$model = new Comment();
		$order = 'ctime ASC';
		$comments = $model->getComments($type,$appid,0,$order);
		if(empty($comments))
		{
			echo -1;
			exit();
		}
		else
		{
			//剔除第一条信息
			unset($comments[0]);
			$data['comments'] = $comments;
			$data['id'] = $appid;
			$this->renderPartial('reply_div',$data);
		}

	}
}
