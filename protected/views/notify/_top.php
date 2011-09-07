<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$items =array(
			array('label'=>'<span>收件箱</span>', 'url'=>array('/notify/inbox')),
			array('label'=>'<span>发件箱</span>', 'url'=>array('/notify/outbox')),
			array('label'=>'<span>通知</span>', 'url'=>array('/notify/index')),
			array('label'=>'<span>写短消息</span>', 'url'=>array('/notify/write')),
		);
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));
	?>
</div>
