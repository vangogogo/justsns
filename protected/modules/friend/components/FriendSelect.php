<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class FriendSelect extends CWidget
{
	public $items=array();

	public function run()
	{
		$items=array();

		$this->render('FriendSelect',array('id'=>''));
	}
}