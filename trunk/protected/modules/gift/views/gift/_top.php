<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/gift.css');?>
<!-- page_title begin -->
<div class=page_title>
	<h2><img src="<?php echo Yii::app()->theme->baseUrl;?>/Public/images/applications.gif" />赠送礼物</h2>
	<div class="c"></div>
</div>
<!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$items =array(
			array('label'=>'<span>礼物中心</span>', 'url'=>array('gift/create')),
			array('label'=>'<span>收到的礼物</span>', 'url'=>array('gift/revice')),
			array('label'=>'<span>送出的礼物</span>', 'url'=>array('gift/send')),
		);
		
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$items,
			'activeCssClass'=>'on',
			'encodeLabel'=>false,
		));
	?>
</div>