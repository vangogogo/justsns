<?php

class GroupModule extends CWebModule
{
	public $isGroupMember,$isGroupAdmin,$isGroupBoss,$isGroupApplicant;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'group.models.*',
			'group.components.*',
		));
		$this->initGroupRole();
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
	        $cs = Yii::app()->clientScript;
	        $cs->registerCssFile('/css/group.css');
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public function initGroupRole()
	{
		$uid = Yii::app()->user->id;
		if(empty($uid))
			return false;
		$gid = Yii::app()->request->getQuery('gid');
		$tid = Yii::app()->request->getQuery('tid');
		if(empty($gid) AND !empty($tid))
		{
			$topic = GroupTopic::model()->loadTopic($tid);
			$gid = $topic->gid;
		}

		if(!empty($gid))
		{
			$model = new Group();
			$model->primaryKey = $gid;
			
			$member = $model->loadMember($uid);
			if(!empty($member))
			{
				$status = $member->status;
				//申请加入 但未通过
				if($status == 0)
				{
					$this->isGroupApplicant = true;
				}
				//申请通过
				$level = $member->level;
				if($level > 0)
					$this->isGroupMember = true;
				if($level > 1)
					$this->isGroupAdmin = true;
				if($level > 2)
					$this->isGroupBoss = true;				
			}
		}
	}
		
	public static function isGroupBoss()
	{
		return $this->isGroupBoss;
	}
	
	public static function isGroupAdmin()
	{
		return $this->isGroupAdmin;
	}

	public static function isGroupMember()
	{
		return $this->isGroupMember;
	}
}
