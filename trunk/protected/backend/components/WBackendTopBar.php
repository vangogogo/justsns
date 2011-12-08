<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WBackendTopBar extends CWidget
{
	public $title='';

	public function run()
	{
		//用户状态
		$data = array();
		$this->render('WBackendTopBar',$data);
	}
}
