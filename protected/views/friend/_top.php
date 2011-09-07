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
				array('label'=>'<span>我的好友</span>', 'url'=>array('/friend/index')),
				array('label'=>'<span>好友屏蔽</span>', 'url'=>array('/friend/ping')),
				array('label'=>'<span>访问脚印</span>', 'url'=>array('/friend/track')),
				array('label'=>'<span>查找朋友</span>', 'url'=>array('/friend/find')),
				array('label'=>'<span>邀请好友</span>', 'url'=>array('/invite/index')),
			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的好友</span>', 'url'=>array('/friend/index','uid'=>$uid)),
				array('label'=>'<span>邀请好友</span>', 'url'=>array('/invite/index')),
			);
		}
		
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>
