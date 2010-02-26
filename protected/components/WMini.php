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
		
		$model = new mini();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>$uid);
		
		$mini = $model->find($criteria);
		
		$icon_list = smile::model()->findAll();
		
		$data = array(
			'mini'=>$mini,
			'icon_list'=>$icon_list,
		);
		$this->render('WMini',$data);
	}
}