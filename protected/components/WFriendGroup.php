<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WFriendGroup extends CWidget
{
	public $items=array();
	public $url = 'friend';

	public function run()
	{

		$uid		 =		intval($_GET["uid"]);

		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->condition="uid=0 OR uid=:uid";
		$criteria->params=array(':uid'=>Yii::app()->user->id);
		
		$model = new FriendGroup();
		$groups = $model->findAll($criteria);

		if($_GET["uid"]) $other = "/uid/".$_GET["uid"];
		
		// $data["cur_url"] = isset( $data['this_url'] ) ? $data['this_url']:C("TS_URL")."/index.php?s=/".MODULE_NAME."/".ACTION_NAME.$other;
		$url = $this->url;
		
		$data = array(
			'groups' => $groups,
			'url' => $url,
		);

		$this->render('WFriendGroup',$data);
	}
}