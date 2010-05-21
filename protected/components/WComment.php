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
	public $appid;
	public $mid;
	public $face;
	public $role;

	public function run()
	{
		$data = $this->items;
		
		$role = $data['role'];
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
		$comments = $model->getComments($type,$appid);
		
		$data['icon_list'] = smile::model()->findAll();
		
		$this->render('Wcomment',$data);
	}
}