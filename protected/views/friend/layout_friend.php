<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/friend.css');?>
<?php $this->beginContent('//layouts/main'); ?>

<?php if(!empty($this->pageTitle)):?>
	<div class="page-header">
		<h1><?php echo $this->pageTitle;?></h1>
	</div>
<?php endif;?>

	<div class="content">
		<?php echo $content; ?>
	</div>
	<div class="sidebar">
	    <h2><?php echo CHtml::link('> 好友列表',array('/friend/index'));?></h2>
	    <h2><?php echo CHtml::link('> 黑名单',array('/friend/ping'));?></h2>

	    <br/>
	    <h2><?php echo CHtml::link('> 邀请好友',array('/invite'));?></h2>
	</div>

<?php $this->endContent(); ?>
