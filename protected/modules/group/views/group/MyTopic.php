<div class="grid_15 suffix_1">
	<h2>我最近回应的话题 ······</h2>
	<div class="zbar clearfix">
		<div>
            <a href="http://www.douban.com/group/">最新话题</a>
            <span class="now"><span>我发起的话题</span></span>
            <a href="http://www.douban.com/group/my_replied_topics">我回应的话题</a>
    	</div>
    </div>
    
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('no_author'=>1,'threads'=>$threads,'group'=>$group));
	?>

	<?php if(!empty($pages)):?>
		<div class="baikeUserPage">
			<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
		</div>
	<?php endif;?>

</div>
<div class="grid_8">
	<?php $this->widget('WGroupSidebar'); ?>
</div>