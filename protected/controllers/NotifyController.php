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
		$user = new user();
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
		$user = new user();
		
		$uid = Yii::app()->user->id;
		$model = new Msg();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime';
		$criteria->condition="t.toUserId =:uid";
		$criteria->params=array(':uid'=>$uid);


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
		
		
		$uid = Yii::app()->user->id;
		$model = new Msg();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime';
		$criteria->condition="t.fromUserId =:uid";
		$criteria->params=array(':uid'=>$uid);


		//取得数据总数,分页显示
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);		
		//获取数据集
		$msgs = $model->findAll($criteria);

		
		$data = array(
			'msgs'=>$msgs,
		);
		$this->render('inbox',$data);
	}	
}
