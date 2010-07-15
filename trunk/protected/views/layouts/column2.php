<?php $this->beginContent(); ?>
	<div id="content_main" class="clearfix">
	
		<div class="span-4" id="sidebar">
			<?php if(!Yii::app()->user->isGuest) $this->widget('UserApp'); ?>

		</div>
		<div class="span-21 last" id="main">
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl), 
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
			
		<?php echo $content; ?>
		</div>
	</div><!-- content -->
<?php $this->endContent(); ?>