<div class="content">
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('no_group'=>1,'threads'=>$threads,'group'=>$group));
	?>
	<div class="pagination">
		<?php $this->widget('ext.bootstrap.widgets.BootPager',array('pages'=>$pages)); ?>
	</div>
</div>
<div class="sidebar">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
