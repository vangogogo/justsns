<div class="content">

	<h2>小组 ······</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$group_list));?>

	<div class="pagination">
    	<?php $this->widget('ext.bootstrap.widgets.BootPager',array('pages'=>$group_pages)); ?>
	</div>
</div>
<div class="sidebar">
	<img class="cover" src="/images/imgad.jpg" />
	<br/>
	<?php $this->widget('WGroupSidebar'); ?> 
</div>
