<div class="page-header">
	<h1><?php echo $group['name'];?></h1>
</div>

<div class="content">
	<div class="alert-message block-message warning">
		<a class="close" href="#"></a>
		<?php echo $group['logo'];?>

		<?php
			YiicmsHelper::CMarkdown($group->intro);
		?>

		<div class="cdate">创建于 <?php echo YiicmsHelper::friendlyDate('m-d H:i',$group['ctime'])?></div>
		<div class="member_op"> &nbsp
			<?php if($this->module->isGroupMember):?>
				我是这个小组的成员 > <a href="#">退出小组</a>
			<?php endif;?>
			
				<span style="float:right">
					<?php if(!$this->module->isGroupMember):?>
					<a href="#" class="btn primary">加入小组</a>
					<?php endif;?>
					<a href="#" class="btn info">推荐</a>
				<span>			
		</div>
		<div class="clearfix">  </div>
	</div>
	<h2>小组最近话题 ······</h2>
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('no_group'=>1,'threads'=>$threads,'group'=>$group));
	?>
	<div class="topicbottom">
		<?php if($page_count>1):?>
		<div class="dislib">
			<?php echo CHtml::link('> 更多小组话题',array('group/discussion','gid'=>$group['id'],'page'=>2));?>
		</div>
		<?php endif;?>
	</div>
</div>
<div class="sidebar">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>