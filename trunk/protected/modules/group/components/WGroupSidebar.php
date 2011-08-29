<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WGroupSidebar extends CWidget
{
	public $gid;
	public function run()
	{
		$model = new Group();
		$groups_count = $model->countGroups();
		$data = array(
			'groups_count'=>$groups_count,
		);
		$this->render('WGroupSidebar',$data);
	}
}
