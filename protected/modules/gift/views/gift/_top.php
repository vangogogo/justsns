<?php 
	$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/gift.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/gift.js');
?>
<!-- page_title begin -->
    <?php if(!empty($this->pageTitle)):?>
		<div class="page-header">
			<h1><?php echo $this->pageTitle;?></h1>
		</div>
	<?php endif;?>
<!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$items =array(
			array('label'=>'<span>礼物中心</span>', 'url'=>array('/gift/gift/index')),
			array('label'=>'<span>收到的礼物</span>', 'url'=>array('/gift/gift/reciveBox')),
			array('label'=>'<span>送出的礼物</span>', 'url'=>array('/gift/gift/sendBox')),
		);
		
		$this->widget('ext.bootstrap.widgets.menu.BootTabs',array(
			'items'=>$items,
			'activeCssClass'=>'on',
			'encodeLabel'=>false,
		));
	?>
</div>
