<?php

class CommentController extends Controller
{
	public function actionIndex()
	{
		
	}
	/*
	 * 显示评论列表
	 */
	public function actionGetComment()
	{
		$page = $_GET['page'];
		$mid = $_POST['mid'];
		$id = $_POST['id'];
		$type = $_POST['type'];
		$appid = $_POST['id'];
		
		$model = new Comment();
		$comments = $model->getComments($type,$appid);
		
		$data = array(
			'comments'=>$comments,
		);
		$this->renderPartial('list',$data);	
		
	}
	
	public function actionGetCount()
	{
		$mid = $_POST['mid'];
		$id = $_POST['id'];
		$type = $_POST['type'];
		$type = $_POST['type'];
		
		$model = new Comment();
		$count = $model->getCount($type,$appid);
		
		return $count;
	}
	/*
	 * 发表评论
	 */
	public function actionDoAddComment()
	{
		$mid = $_POST['mid'];
		$id = $_POST['id'];
		$type = $_POST['type'];
		$appid = $_POST['appid'];
		$comment = $_POST['comment'];
		$quietly = $_POST['quietly'];
		$toId = $_POST['toId'];
		
		$model = new Comment();
		
		$params = array(
			'type'=>$type,
			'appid'=>$appid,
			'comment'=>$comment,
			'toId'=>$toId,
			'quietly'=>$quietly,
		);
		
		$model->attributes = $params;
		$model->save();
		if(!empty($model->errors))
		{
			echo -1;
			exit();
		}
		$data = $model->attributes;
		$data['face']=$model->user->getUserFace();
		echo CJSON::encode($data);
	}
	
	/*
	 * 删除评论
	 */
	public function actionDoDelComment()
	{
		$id = $_POST['id'];
		$appid = $_POST['appid'];
		$params = array(
			'id'=>$id,'appid'=>$appid,
		);
		
		$model = new Comment();
		$result = $model->deleteByAttributes($params);
		
		
		if($result)
		{
			echo 1;
		}
		else
		{
			echo -1;
		}
	}	
}
