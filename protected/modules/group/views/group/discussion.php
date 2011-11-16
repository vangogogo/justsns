<div class="grid_15 suffix_1">
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('no_group'=>1,'threads'=>$threads,'group'=>$group));
	?>
	<div class="baikeUserPage">
		<?php $this->widget('BootPager',array('pages'=>$pages)); ?>
	</div>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
