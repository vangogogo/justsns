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

		$uid = intval($_GET["uid"]);

		$model = new User();
		$groups = $model->getUserFriendGroups();

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