<div class="grid_15 suffix_1">
	<?php if(!empty($new_groups)):?>
	<h2>最活跃的小组 ······</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$new_groups));?>
	<br/>
	<br/>
	<?php endif;?>
	<h2>小组的最近话题 ······</h2>
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('threads'=>$threads));
	?>
	<div class="topicbottom">
		<a href="/group/list.html">&gt; 更多话题</a>
	</div>
</div>
<div class="grid_8">
	<img class="cover" src="/images/imgad.jpg" />
	<br/>
	<?php $this->widget('WGroupSidebar'); ?>
    <img class="cover" src="/images/tmp_ads1.jpg" />
   
    
</div>
