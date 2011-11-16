<h1>帐号设置</h1>
<!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php $this->widget('ext.bootstrap.widgets.menu.BootTabs',array(
		'items'=>array(
			array('label'=>'帐号设置', 'url'=>array('/user/profile/profile')),
			array('label'=>'积分记录', 'url'=>array('/user/profile/score')),
			array('label'=>'积分说明', 'url'=>array('/user/profile/faq')),
		),
		#'activeCssClass'=>'on',
		'encodeLabel'=>false,
	)); ?>
</div>
<!-- 切换标签 end  -->
