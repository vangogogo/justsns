<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WFriendSelect extends CWidget
{
	public $items=array();

	public function run()
	{
		$items=array();

		$this->render('WFriendSelect',array('id'=>''));
	}
}