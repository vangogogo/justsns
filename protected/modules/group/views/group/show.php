<h1><?php echo $group['name'];?></h1>
<div class="grid_15 suffix_1">
	<div class="groupintro radius">
		<?php echo $group['logo'];?>

		            <?php
			            $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			            echo $group->intro;
			            $this->endWidget();
		            ?>

		<div class="cdate">创建于 <?php echo friendlyDate('m-d H:i',$group['ctime'])?></div>
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
<div class="grid_8">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
