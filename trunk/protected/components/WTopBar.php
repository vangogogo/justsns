<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WTopBar extends CWidget
{
	public $title='';

	public function run()
	{
		$this->renderContent();
	}
	
	protected function renderContent()
	{
		//用户状态
		$data = array();
		$this->render('WTopBar',$data);
	}
}