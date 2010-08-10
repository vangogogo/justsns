<?php

class NotifyController extends Controller
{
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$type = Yii::app()->request->getQuery('type');
		$type_arr = Notify::model()->type_arr;
		$user = new User();
		$notifys = array();

		$uid = Yii::app()->user->id;
		$model = new Notify();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime';
		$criteria->condition="t.uid=:uid";
		$criteria->params=array(':uid'=>$uid);
		

		if(!array_key_exists($type,$type_arr))
		{
			$type = 'all';
		}
		if($type != 'all')
		{
			$condition = "cate = '$cate'";
			$criteria->addCondition($condition);
		}

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);		
		//获取数据集
		$notifys = $model->findAll($criteria);
		
		$data = array(
			'type'=>$type,
			'type_arr'=>$type_arr,
			'notifys'=>$notifys,
			'user'=>$user,
		);
		$this->render('index',$data);
	}
	
	public function actionInbox()
	{
		$msgs = array();
		$user = new User();
		
		$uid = Yii::app()->user->id;
		$model = new Msg();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime';
		$criteria->condition="t.toUserId =:uid AND is_del = 0";
		$criteria->params=array(':uid'=>$uid);
		$criteria->order = 'ctime DESC';

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);		
		//获取数据集
		$msgs = $model->findAll($criteria);

		
		$data = array(
			'msgs'=>$msgs,
			'user'=>$user,
		);
		$this->render('inbox',$data);
	}
	
	public function actionOutbox()
	{
		$msgs = array();
		$user = new User();
		
		$uid = Yii::app()->user->id;
		$model = new Msg();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime';
		$criteria->condition="t.fromUserId =:uid AND is_del = 0";
		$criteria->params=array(':uid'=>$uid);
		$criteria->order = 'ctime DESC';

		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		//获取数据集
		$msgs = $model->findAll($criteria);

		
		$data = array(
			'msgs'=>$msgs,
			'user'=>$user,
		);
		$this->render('inbox',$data);
	}	
	
	public function actionWrite()
	{
		$uid = Yii::app()->request->getQuery('uid');
        if($uid){
        	$user = new User();
            $toUserFace = $user->getUserFace($uid);
            $toUserName = $user->getUserName($uid);
        }
        $mid = Yii::app()->user->id;
        
        $model = new Msg();
        
		if(isset($_POST['Msg']))
		{
			$friend_ids = $_POST['friend_ids'];
			
			if(!empty($friend_ids))
			{
				//先对某个用户发送问候
				foreach($friend_ids as $toUserid)
				{
					$model=new Msg();
					$model->attributes=$_POST['Msg'];
					$model->toUserId = $toUserid;
					$model->fromUserId = $mid;
					
					$result = $model->save();
				}
				if($result == true)
				{
					$this->redirectMessage('发送短信息成功！',array('outbox'),20);
				}
				//请选择好友
				//throw new CHttpException(404,'请选择好友.');
			}

		}
		$data = array(
			'toUserFace'=>$toUserFace,
			'toUserName'=>$toUserName,
			'model'=>$model,
		);
		$this->render('write',$data);
	}
	
	public function actionShow()
	{
		$msg_id = Yii::app()->request->getQuery('msg_id');
		$model =  new Msg();
		$msg = $model->findByPk($msg_id);
		$mid = $this->mid;
		if($msg->fromUserId != $mid AND $msg->toUserId != $mid)
		{
			//请选择好友
			throw new CHttpException(404,'你没有权限访问这个页面。');
		}
		
		$uid = $msg->toUserId == $mid?$msg->fromUserId:$msg->toUserId;
		$user = User::model()->findByPk($uid);
		
		$msg->readMsg();
		
		$data = array(
			'msg'=>$msg,
			'user'=>$user,
			'uid'=>$uid,
		);
		$this->render('show',$data);
	}
	
	public function actionDoDelMsg()
	{
		$msg_id = Yii::app()->request->getQuery('msg_id');
		$model = new Msg();
		$msg = $model->loadMsg($msg_id);
		$return = $msg->delMsg();
		echo $return;
	}
}
