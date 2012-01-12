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
		$object_id = $_POST['id'];

		$model = new Comment();
		$comments = $model->getComments($type,$object_id);

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
		$count = $model->getCount($type,$object_id);

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
		$object_id = $_POST['object_id'];
		$comment = $_POST['comment'];
		$quietly = $_POST['quietly'];
		$toId = $_POST['toId'];

		$model = new Comment();

		$params = array(
			'type'=>$type,
			'object_id'=>$object_id,
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
		//		$data = $model->attributes;
		//		$data['face']=$model->user->getUserFace();
		//		echo CJSON::encode($data);

		$comment = $model->attributes;
		$comment['face']=$model->user->getUserFace();

		if(!$comment[toId])
		{
			$data['comment'] = $comment;
			$this->renderPartial('comment_li',$data);
		}
		else
		{
			$data['subcomment'] = $comment;
			$this->renderPartial('subcomment_li',$data);
		}
	}

	/*
	 * 删除评论
	 */
	public function actionDoDelComment()
	{
		$id = $_POST['id'];
		$object_id = $_POST['object_id'];
		$params = array(
			'id'=>$id,'object_id'=>$object_id,
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
