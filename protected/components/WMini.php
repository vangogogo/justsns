<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WMini extends CWidget
{
	public $mini_zishu = 140;
	public $mini_ajax = array('doAddMini','doDeleteMini','getReply','getReplyCount','doReplyMini','doAddReply','doDeleteReply');
	
	public $items=array();

	public function run()
	{
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/mini.js');
		
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