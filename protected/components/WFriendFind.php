<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WFriendFind extends CWidget
{
	public $items=array();

	public function run()
	{
		$items=array();
		$this->render('WFriendFind',array('id'=>''));
	}
}
