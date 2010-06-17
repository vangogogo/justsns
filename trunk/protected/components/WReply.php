<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WReply extends CWidget
{
	public $reply=array();

	public $uid;
	public $mid;
	public $id;

	public function run()
	{
		$replys = $this->reply;

		$count = count($replys);

		$first = $replys[0];
		if($count > 2)
		{
			$last = $replys[$count-1];
		}
		$mid = Yii::app()->user->id;

		$data = array(
			'replys'=>$replys,
			'count'=>$count,
			'first'=>$first,
			'last'=>$last,
			'mid'=>$mid,		
			'uid'=>$this->uid,
			'id'=>$this->id,
		);

		$this->render('WReply',$data);
	}
}