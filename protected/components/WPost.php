<?php
/**
 * WPost
 *
 */
class WPost extends CWidget
{
	public $items=array();
	public $url = 'friend';
	public $model;
	public $action;

	public function run()
	{
		$post = new GroupPost();
		$post = $this->model;
		$data = array(
			'model' => $post,	
		);

		$this->render('WPost',$data);
	}
}