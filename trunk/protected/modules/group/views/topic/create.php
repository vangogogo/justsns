<h1><?php echo $group['name']?> 发言</h1>
<div class="grid_15 suffix_1">
<?php
	//话题列表
	$this->renderPartial('_form',array('model'=>$topic));
?>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
