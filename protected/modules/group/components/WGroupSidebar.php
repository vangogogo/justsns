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

		$this->render('WGroupSidebar',$data);
	}
}