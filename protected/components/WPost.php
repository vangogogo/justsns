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

	public function run()
	{
		$post = new GroupPost();
		$data = array(
			'model' => $post,	
		);

		$this->render('WPost',$data);
	}
}