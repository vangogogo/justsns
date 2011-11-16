<h1>小组设置</h1>
<div class="content">
	<?php
		//话题列表
		$this->renderPartial('_form',array('model'=>$group,'category_list'=>$category_list));
	?>
</div>
<div class="sidebar">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
