<?php
/**
 * Wcomment
 *
 */
class Wcomment extends CWidget
{
	public $items=array();
	public $url = 'friend';
	public $type;
	public $object_id;
	public $mid;
	public $face;
	public $role;

	public function run()
	{
		$data = $this->items;

		$role = $data['role'];
		$type = $data['type'];
		$object_id = $data['object_id'];

		switch($role)
		{
			case 2:
				echo "您无法评论,日志发布者设置好友可评论";exit();
				break;
			case 3:
				echo "您无法评论,日志发布者已经关闭评论";exit();
				break;
		}

		$model = new Comment();
		$comments = $model->getComments($type,$object_id);
		$data['icon_list'] = Smile::model()->findAll();
		$data['comments'] = $comments;

		$this->render('WComment',$data);
	}
}