<?php

class GiftController extends Controller
{

	public $defaultAction='create';

	public $accessOptions = '';

	public $image_dir = '';

	const PAGE_SIZE=20;

	public function init()
	{
		parent::init();
		$this->accessOptions =  GiftUser::model()->getAccessOptions();
		$this->image_dir = Yii::app()->request->baseUrl.'/images/gift/';
	}

	public function actionIndex()
	{
		//添加补充信息
		$this->accessOptions = array(
			0 => '公开赠送',
			1 => '私下赠送(不让其他人知道是你送的)',
			2 => '匿名赠送(不让接收礼物的人知道是你送的)',	
		);
		$giftCategory = GiftCategory::model()->getCategorys();
		
		$model=new GiftUser;
		//礼物的种类
		$criteria=new CDbCriteria;
		$criteria->condition="status=:status";
		$criteria->params=array(':status'=>1);
		//取得数据总数,分页显示
		$total = Gift::model()->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$gifts = Gift::model()->findAll($criteria);

		$data = array(
			'giftCategory'=>$giftCategory,
			'gifts' => $gifts,
			'model'=>$model,
			'pages'=>$pages,
		);

		$this->render('index',$data);
	}

	/**
	 * 收到的礼物
	 */
	public function actionRevice()
	{

		$model=new GiftUser;

		//初始化
		$criteria=new CDbCriteria;
		$criteria->condition="toUserid=:toUserid";
		$criteria->params=array(':toUserid'=>Yii::app()->user->id);

		//取得数据总数,分页显示
		$total = GiftUser::model()->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$gifts = GiftUser::model()->with('sender')->together()->findAll($criteria);

		$data = array(
			'gifts' => $gifts,
			'pages' => $pages,
		);

		$this->render('revice',$data);
	}


	/**
	 * 发出的礼物
	 */
	public function actionSend()
	{
		$model=new GiftUser;

		//初始化
		$criteria=new CDbCriteria;
		$criteria->order="cTime DESC";
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>Yii::app()->user->id);

		//取得数据总数,分页显示
		$total = GiftUser::model()->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$gifts = GiftUser::model()->with('sender')->together()->findAll($criteria);

		$data = array(
			'gifts' => $gifts,
			'pages' => $pages,
		);

		$this->render('send',$data);
	}

	/**
	 * 礼物发送页面
	 */
	public function actionCreate()
	{
		//添加补充信息
		$this->accessOptions = array(
			0 => '公开赠送',
			1 => '私下赠送(不让其他人知道是你送的)',
			2 => '匿名赠送(不让接收礼物的人知道是你送的)',	
		);

		$model=new GiftUser;


		//礼物的种类
		$criteria=new CDbCriteria;
		$criteria->condition="status=:status";
		$criteria->params=array(':status'=>1);

		//取得数据总数,分页显示
		$total = Gift::model()->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		//获取数据集
		$gifts = Gift::model()->findAll($criteria);

		if(isset($_POST['GiftUser']))
		{
			//传递数据格式为fuid =  1,2,4
			/*
			$friend_str = $_POST['fri_ids'];
			$friend_ids = explode(',',$friend_str) ;
			*/
			$friend_ids = $_POST['friend_ids'];
				
			if(empty($friend_ids))
			{
				//请选择好友
				throw new CHttpException(404,'请选择好友.');
			}
				
			$gift_ids = $_POST['gift_ids'];
			if(empty($gift_ids))
			{
				//请选择礼物的种类
				throw new CHttpException(404,'先选择礼物.');
			}


			//先对某个用户发送礼物
			foreach($friend_ids as $toUserid)
			{
				//发送各种礼物
				foreach($gift_ids as $giftid)
				{
						
					$model=new GiftUser;
					$model->attributes=$_POST['GiftUser'];
					$model->toUserid = $toUserid;
					$model->giftid = $giftid;
					$model->save();
				}
			}
				
			//跳转到发送页
			$this->redirect(array('send'));

		}

		$data = array(
			'gifts' => $gifts,
			'model'=>$model,
			'pages'=>$pages,
		);

		$this->render('create',$data);
	}
}