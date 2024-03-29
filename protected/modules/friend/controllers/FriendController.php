<?php

class FriendController extends CController
{
	
	public $defaultAction='list';
		
	const PAGE_SIZE=20;
		
	public function actionIndex()
	{
		//群组分类
		
		
		$this->render('index');
	}
	
	public function actionList()
	{
		$gid = Yii::app()->request->getParam('gid');
		$uid = Yii::app()->request->getParam('uid');
		if($uid) {
				$is_me = ($this->mid == $uid);
		}else {
				$is_me = true;
		}

		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='dateline';
		$criteria->condition="uid=:uid AND status = 1";
		$criteria->params=array(':uid'=>Yii::app()->user->id);

		if(!empty($gid))
		{
			$criteria->addCondition('gid='.$gid);
		}

		//取得数据总数,分页显示
		$total = Friend::model()->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$friend_list = Friend::model()->with('user')->findAll($criteria);
		//好友信息,获取好友记录等等
		$friends = array();
		if(!empty($friend_list))
		{
			foreach($friend_list as $key => $value)
			{
				$user = $value->user;
				if(!empty($user))
					$friends[$key] = $user;
			}
		}


		//在线人数
		$online = 0;

		$data = array(
			'is_me' => $is_me,
			'uid' => $uid,
			'friends' => $friends,
			'gid' => $gid,
			'pages' => $pages,
			'total' => $total,
			'online' => $online,
		);
		
		$this->render('list',$data);
	}
		
	
	public function actionCreate()
	{

		$model=new Friend;

		if(isset($_POST['Friend']))
		{
			$model->attributes=$_POST['Friend'];
			
			if($model->save())
			{
				$this->redirect(array('show','tid'=>$model->id));
			}

		}
		$this->render('create',array('model'=>$model));
	}
	
	
	
	public function actionFeed()
	{

		$model=new Friend;

		if(isset($_POST['Friend']))
		{
			$model->attributes=$_POST['Friend'];
			
			if($model->save())
			{
				$this->redirect(array('show','tid'=>$model->id));
			}

		}
		
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('feed',$data);
		}else{
			$this->render('feed',$data);
		}
	}
	
	
	/**
	 * 好友分组，多选
	 */
	public function actionGroup()
	{
		
		$criteria=new CDbCriteria;
		$criteria->condition = 'uid=:uid OR uid = 0';
		$criteria->params = array(':uid'=>Yii::app()->user->id);
		$friendGroup = FriendGroup::model()->findAll($criteria);
		if(empty($friendGroup))
		{
			//没有分组,先添加分组
			//$this->redirect(array('group/create'));
		}
		
		$fuid = Yii::app()->request->getParam('id');			
		//检查是否好友
		//尚未
		
		//好友所属的分组
		$model=new FriendBelongGroup;
		$criteria=new CDbCriteria;
		$criteria->condition = 'uid=:uid AND fuid=:fuid';
		$criteria->params = array(':uid'=>Yii::app()->user->id,':fuid'=>$fuid);
		$list = $model->findAll($criteria);
		$frienBelongdGroup = array();
		if(!empty($list))
		{
			foreach($list as $key => $value)
			{
				$frienBelongdGroup[$value['gid']] = $value['gid'];
			}
		}

		if(isset($_POST['FriendBelongGroup']))
		{


			foreach($_POST['FriendBelongGroup'] as $gid)
			{
				//已经存在则剔除
				if(in_array($gid,$frienBelongdGroup))
				{
					unset($frienBelongdGroup[$gid]);
				}
				else
				{
					$attributes = array(
						'uid' => Yii::app()->user->id,
						'fuid' => $fuid,
						'gid' => $gid,
					);
					$model=new FriendBelongGroup;
					$model->attributes=$attributes;
					$model->save();
				}
			}

			if(!empty($frienBelongdGroup))
			{
				foreach($frienBelongdGroup as $gid)
				{
					
					$attributes = array(
						'uid' => Yii::app()->user->id,
						'fuid' => $fuid,
						'gid' => $gid,
					);
					$model=new FriendBelongGroup;
					$del = $model->deleteAllByAttributes($attributes);

				}
			}

			$this->redirect(array('list'));


		}
		
		$data = array(
			'friendGroup' => $friendGroup,
			'model' => $model,
			'frienBelongdGroup' => $frienBelongdGroup,
		);
		
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('group',$data);
		}else{
			$this->render('group',$data);
		}
				
	}
	
	
	/**
	 * 好友删除，需要将对应的好友字段删除
	 */
	public function actionDelete()
	{
		$model=new Friend;
		
		$uid = Yii::app()->user->id;
		$fuid = Yii::app()->request->getParam('id');

		$criteria=new CDbCriteria;
		$criteria->condition = 'uid=:uid AND fuid=:fuid';
		$criteria->params = array(':uid'=>$uid,':fuid'=>$fuid);
		$model = Friend::model()->find($criteria);
		if(empty($model))
		{
			throw new CHttpException(404,'不是好友.');
		}
		
		if(isset($_POST['Friend']))
		{
			if($model->delete())
				$this->redirect(array('list'));
		}		
		
		$data = array(
			'model' => $model,
		);
		
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('delete',$data);
		}else{
			$this->render('delete',$data);
		}
	}
	
	
	/**
	 * 好友添加
	 */
	public function actionAdd()
	{
		$model=new Friend;
		
		$uid = Yii::app()->user->id;
		$fuid = Yii::app()->request->getParam('id');

		$msg = '';
		//不允许加自己好友
		if($fuid == $uid) 
		{
			$msg ='不允许自己加自己好友';
		}
		
		$t = Yii::app()->request->getParam('t');
		//加好友的权限设置
		if($t != "agree") 
		{
			//$model->__checkeFriendPrivacy($fuid);
		}

		//检查好友状态
		$is_add = $model->checkFriendStatus($uid, $fuid);
		if("1" === $is_add) 
		{
			$msg ='你们已经是好友了';

		}
		elseif("0" === $is_add)
		{
			$msg ='等待验证中';
		}

		//对方已经发过请求了，直接就加为好友
		if ("0" === $model->checkFriendStatus($fuid, $uid)) {
			//并且弹出好友分组页面
			//$model->__straightAddFrends($fuid,intval($_GET['nid']));
		}
		
		$model->fuid = $fuid;
		
		if(isset($_POST['Friend']))
		{
			$model->attributes=$_POST['Friend'];

			if($model->save())
				$this->redirect(array('list'));
		}		
		

		$data = array(
			'model' => $model,
			'msg' => $msg
		);
		
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create',$data);
		}else{
			$this->render('create',$data);
		}
	}
	

	private function __addFrendsError($msg) {
		throw new CHttpException(404,$msg);
	}	
	
	/**
	 * 用户列表
	 */
	public function actionFind()
	{
		$online = Yii::app()->request->getParam('online');		

		$criteria=new CDbCriteria;
		
		$withOption=array();

		if($online=='1')
		{
			$withOption= array('onlineFilter');

			$total=User::model()->with($withOption)->count($criteria);
			$criteria->distinct=true;
		}
		else
		{
			$total=User::model()->count($criteria);
		}

		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$users = User::model()->with($withOption)->together()->findAll($criteria);
		
		$data = array(
			'users' => $users,
			'pages' => $pages
		);
		$this->render('find',$data);
	}

	//------------------------------------------------以下是选择好友组件相关-----------------------------------
	public function actionAjax() {
		$model = new Friend();
		
		$name = Yii::app()->request->getParam('name');
		$out = '';
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->condition="uid=:uid AND status = 1";
		$criteria->params=array(':uid'=>Yii::app()->user->id);
		
		//用户名前匹配
		$likecd = "fusername LIKE '".$name."%'";
		$criteria->addCondition($likecd);

		$friends = $model->findAll($criteria);

		foreach($friends as $key=>$value) {
				$out[$key]["fUid"] = $value["fuid"];
				$out[$key]["friendUserName"] = $value["fusername"];
				$out[$key]["friendHeadPic"] = '';
		}


		echo '('.CJSON::encode($out).')';
	}

	public function actionGetAllFriends() {
		$model = new Friend();
		
		$uid = Yii::app()->user->id;
		$gid = Yii::app()->request->getParam('type');		

		$page = Yii::app()->request->getParam('pageSize');
		$_GET["page"] = $page;
		$out = '';
		
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='dateline';
		$criteria->condition="friend.uid=:uid AND status = 1";
		$criteria->params=array(':uid'=>Yii::app()->user->id);
		
		$withOption=array('user');

		//取得数据总数,分页显示		
		if(!empty($gid))
		{
			//去除AR，手动LEFT JOIN
			$tablename = FriendBelongGroup::model()->tableName();
			$modelname = Friend::model()->tableName();
			$criteria->join = "LEFT JOIN {$tablename} ON {$tablename}.uid = {$modelname}.uid AND {$tablename}.fuid = {$modelname}.fuid";
			$criteria->addCondition('gid='.$gid);

			$total=Friend::model()->count($criteria);
		}
		else
		{
			$total=Friend::model()->count($criteria);
		}

		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$friends=Friend::model()->with($withOption)->together()->findAll($criteria);
		
		foreach($friends as $key=>$value) {
				$out[$key]["fUid"] = $value["fuid"];
				$out[$key]["friendUserName"] = $value["fusername"];
				$out[$key]["friendHeadPic"] = '';// getUserFace($v["fuid"])
		}

		echo '('.CJSON::encode($out).')';
	}

	public function actionGetFriendType() {

		$criteria=new CDbCriteria;
		$criteria->condition="uid=:uid OR uid = 0";
		$criteria->params=array(':uid'=>Yii::app()->user->id);
				
		$models = FriendGroup::model()->findAll($criteria);

		echo '('.CJSON::encode($models).')';
	}

	public function actionGetCountUrl() {
		$gid = Yii::app()->request->getParam('typeId');		
		
		echo Friend::model()->getFriendNumber(Yii::app()->user->id,$gid);
	}

	//----------------------------------------------组件 end----------------------------------------------
}
