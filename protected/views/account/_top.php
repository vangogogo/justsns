<!-- page_title begin -->
<div class=page_title>
	<h2><img src="<?php echo Yii::app()->theme->baseUrl;?>/public/images/applications.gif" />帐号管理</h2>
	<div class="c">
	</div>
</div>
<!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'<span>修改密码</span>', 'url'=>array('/account/index')),
			array('label'=>'<span>修改账号</span>', 'url'=>array('/account/account')),
			array('label'=>'<span>账号安全</span>', 'url'=>array('/account/security')),
			array('label'=>'<span>积分记录</span>', 'url'=>array('/account/score')),
			array('label'=>'<span>积分说明</span>', 'url'=>array('/account/faq')),
		),
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
	)); ?>
</div>
<!-- 切换标签 end  -->
