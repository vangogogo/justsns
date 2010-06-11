<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WMini extends CWidget
{
	public $items=array();

	public function run()
	{
		$items=array();

		$uid = Yii::app()->user->id;

		$model = new Mini();
		$mini =$model->getLastMiniByUid($uid);

		$smile = new Smile();
		$icon_list = $smile->getIconList();

		$data = array(
			'mini'=>$mini,
			'icon_list'=>$icon_list,
		);
		$this->render('WMini',$data);
	}
}