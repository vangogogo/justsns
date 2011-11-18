<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/friend.css');?>
<?php 
	$cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/gift.css');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/gift.js');
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
    <?php if(!empty($this->pageTitle)):?>
		<div class="page-header">
			<h1><?php echo $this->pageTitle;?></h1>
		</div>
	<?php endif;?>
	<div class="content">
		<?php echo $content; ?>
	</div>
	<div class="sidebar">
	    <h2><?php echo CHtml::link('> 礼物中心',array('gift/index'));?></h2>
	    <h2><?php echo CHtml::link('> 收到的礼物',array('gift/reciveBox'));?></h2>
	    <h2><?php echo CHtml::link('> 送出的礼物',array('gift/sendBox'));?></h2>

	</div>
</div>
<?php $this->endContent(); ?>
