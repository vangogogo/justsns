<?php
class EAccess extends CApplicationComponent
{
	private $_routes=array();

	/**
	 * Initializes this application component.
	 * This method is required by the IApplicationComponent interface.
	 */
	public function init()
	{
		parent::init();

		//开始请求时，代码
		if(!Yii::app()->user->isGuest){
			Yii::app()->attachEventHandler('onBeginRequest',array($this,'refreshOnline'));
		}else{
			
		}

	}

	/**
	 * 刷新在线时间
	 */
	public function refreshOnline()
	{
		$uid = Yii::app()->user->id;
		$user = user::model()->findByPk($uid);
		if(!empty($user))
		{
			$user->refreshOnline();
		}

	}
	
}
