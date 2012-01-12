<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WReply extends CWidget
{
	public $reply=array();
	public $count;
	public $first;
	public $last;
	
	public $uid;
	public $mid;
	public $id;

	public function run()
	{

		$count = $this->count;
		$first = $this->first;
		$last = $this->last;
		

		$mid = Yii::app()->user->id;

		$data = array(
			'count'=>$count,
			'first'=>$first,
			'last'=>$last,
			'mid'=>$mid,		
			'uid'=>$this->uid,
			'id'=>$this->id,
		);
		//这里的id 为Comment中的object_id

		$this->render('WReply',$data);
	}
}