
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
    <?php if(!empty($this->pageTitle)):?><h1><?php echo $this->pageTitle;?></h1><?php endif;?>
	<div class="content">
		<?php echo $content; ?>
	</div>
	<div class="sidebar">
	    <h2><?php echo CHtml::link('> 最爱@我',array('weibo/atme'));?></h2>
	    <h2><?php echo CHtml::link('> 星座起源',array('/astro'));?></h2>

	</div>
</div>
<?php $this->endContent(); ?>
