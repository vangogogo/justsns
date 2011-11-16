<div class="grid_15 suffix_1">

	<h2>小组 ······</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$group_list));?>

    	<?php $this->widget('CLinkPager',array('pages'=>$group_pages)); ?>
</div>
<div class="grid_8">
	<img class="cover" src="/images/imgad.jpg" />
	<br/>
	<?php $this->widget('WGroupSidebar'); ?> 
</div>
