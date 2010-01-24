<div class=page_title> <!-- page_title begin -->
	<h2><img src="../Public/images/applications.gif" />好友管理</h2>
	<div class="c"></div>
</div><!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'<span>我的好友</span>', 'url'=>array('/friend/index')),
			array('label'=>'<span>好友屏蔽</span>', 'url'=>array('/friend/ping')),
			array('label'=>'<span>访问脚印</span>', 'url'=>array('/friend/track')),
			array('label'=>'<span>查找朋友</span>', 'url'=>array('/friend/find')),
			array('label'=>'<span>邀请好友</span>', 'url'=>array('/invite/index')),
		),
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
	)); ?>
</div>