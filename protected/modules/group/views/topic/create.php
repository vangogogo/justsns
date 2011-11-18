<div class="page-header"><h1><?php echo $group['name']?> 发言</h1></div>
<div class="content">
<?php
	//话题列表
	$this->renderPartial('_form',array('model'=>$topic));
?>
</div>
<div class="sidebar">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
