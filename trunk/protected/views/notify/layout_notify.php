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
	    <h2><?php echo CHtml::link('> 回我的发件箱',array('/notify/outbox'));?></h2>
	    <h2><?php echo CHtml::link('> 去我的收件箱',array('/notify/inbox'));?></h2>
	    <br/>
	    <h2><?php echo CHtml::link('> 前往我的好友列表',array('/friend'));?></h2>
    </div>
<?php $this->endContent(); ?>