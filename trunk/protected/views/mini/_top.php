<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mini.js');?>
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$uid = Yii::app()->request->getParam('uid');

		if(!empty($uid)) {
			$is_me = ($this->mid == $uid);
		}else {
			$uid = $this->mid;
			$is_me = true;
		}
		if($is_me)
		{
			$items =array(
				array('label'=>'<span>好友的心情</span>', 'url'=>array('/mini/index')),
				array('label'=>'<span>我的心情</span>', 'url'=>array('/mini/my')),
				array('label'=>'<span>大家的心情</span>', 'url'=>array('/mini/all')),
			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的心情</span>', 'url'=>array('/friend/index','uid'=>$uid)),
			);
		}
		$this->widget('ext.bootstrap.widgets.menu.BootTabs',array(
			'items'=>$items,
			'encodeLabel'=>false,
		));
	?>
</div>
