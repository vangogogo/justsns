
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
        <?php
            if(!empty($this->astros_list)):
                foreach($this->astros_list as $astro):
        ?>
    <h3>
        <a href="<?php echo $astro->getUrl();?>" title="<?php echo CHtml::encode($astro->astro_name)?> <?php echo $astro->astro_date?>"><?php echo CHtml::encode($astro->astro_name)?>
        </a><span class="astro_date"><?php echo $astro->astro_date?></span>
    </h3>
        <?php endforeach;endif;?>

	</div>
</div>
<?php $this->endContent(); ?>
