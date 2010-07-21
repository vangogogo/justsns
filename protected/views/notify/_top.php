<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/notify.css');?>
<div class=page_title> <!-- page_title begin -->
	<h2><img src="<?php echo PUBLIC_URL?>/images/mail_down.gif" />消息</h2>
	<div class="c"></div>
</div><!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php

		$items =array(
			array('label'=>'<span>收件箱</span>', 'url'=>array('/notify/inbox')),
			array('label'=>'<span>发件箱</span>', 'url'=>array('/notify/outbox')),
			array('label'=>'<span>通知</span>', 'url'=>array('/notify/index')),
			array('label'=>'<span><div class="ico_add">&nbsp;</div>写短消息</span>', 'url'=>array('/notify/write')),
		);

		
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>