<?php

class BoardController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('create','reply','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/*
	* 加关注
	*/
	public function actionCreate()
	{
		$params = $_POST;

		$refer =  $params['refer'];

		$board_content = $params['board_content'];
		if($board_content == '点击输入留言内容')
		{
			unset($board_content);
		}
		$uid = Yii::app()->user->id;

		if(empty($uid))
		{
			//跳转到登陆页面

		}
		if(!empty($board_content))
		{


			$object_type = $params['object_type'];
			$object_id = $params['object_id'];



			$formash = md5($params['object_type'].'|'.$params['object_id'].'|'.$params['refer']);
			if($formash !== $params['formash'])
			{
				//hash对应不上，抛出异常
			}

			//发送私人短信
			$board_pm = $_POST['board_pm'];
			if(!empty($board_pm))
			{



			}
			else
			{
				$model = new PeopleBoard();
				$model->object_type =  $object_type;
				$model->object_id =  $object_id;
				$model->uid =  $uid;
				$model->board_content =  $board_content;
				$model->name =  $name;
				$model->save();

				if(!empty($model->errors))
				{
					//var_dump($model->errors);die;
				}
			}
		}



		$this->redirect($refer);

	}

	public function actionReply()
	{
		$params = array(
			'board_reply' => $_POST['board_reply'],
			'object_type' => $_POST['object_type'],
			'object_id' => $_POST['object_id'],
		);
		$PeopleBoard= new PeopleBoard();
		$model = $PeopleBoard -> findPeopleBoard($params);

		$model-> board_reply = $params['board_reply'];
		$model->save();

		$refer =  $params['refer'];
		$this->redirect($refer);
	}

	/*
	* 删除评论
	*/
	public function actionDelete()
	{
		$params = array(
			'board_reply' => $_POST['board_reply'],
			'object_type' => $_POST['object_type'],
			'object_id' => $_POST['object_id'],
		);

		$pk = $_GET['people_pk'];
		$PeopleBoard= new PeopleBoard();
		$model = $PeopleBoard -> findByPk($pk);
		if(!empty($model))
		{
			//当导师未回复前，发表者允许删除. 导师可以自己删除回复	
			if($model->isDeleteAccess())
			{
				$model->deleteMark();
			}	
		}
		$refer = Yii::app()->request->urlReferrer;
		$this->redirect($refer);
	}	

}
