<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
    <?php if(!empty($this->pageTitle)):?><h1><?php echo $this->pageTitle;?></h1><?php endif;?>
	<div class="grid_15 suffix_1">
		<?php echo $content; ?>
	</div>
    <div class="grid_8">
	    <h2><?php echo CHtml::link('> 回我的发件箱',array('/notify/outbox'));?></h2>
	    <h2><?php echo CHtml::link('> 去我的收件箱',array('/notify/inbox'));?></h2>
	    <br/>
	    <h2><?php echo CHtml::link('> 前往我的好友列表',array('/friend'));?></h2>
    </div>
</div>
<?php $this->endContent(); ?>
