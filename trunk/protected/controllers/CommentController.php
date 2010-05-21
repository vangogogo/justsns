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
		
		$model = new Comment();
		$count = $model->getCount($type,$appid);
		
		return $count;
	}
	/*
	 * 发表评论
	 */
	public function doAddComment()
	{
		
	}
}
