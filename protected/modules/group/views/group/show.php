<div class="grid_15 suffix_1">
	<h1><?php echo $group['name'];?></h1>
	<br/>
	<br/>
	<div id="groupintro">
		<table class="groupintro_t">
			<tr>
				<td width="76">
					<div id="image">
						<?php echo $group['logo'];?>
					</div>
				</td>
				<td>
					<?php echo $group['intro'];?>
				</td>
			</tr>
		</table>
		<div class="cdate">
			创建于 <?php echo friendlyDate('m-d H:i',$group['ctime'])?>
		</div>
	</div>
	<br/>
	<br/>
	
	<h2>小组最近话题 ······</h2>
	<?php
		//话题列表
		$this->renderPartial('../topic/_list',array('no_group'=>1,'threads'=>$threads,'group'=>$group));
	?>

	<?php if(empty($_GET['page'])){ if($page_count>1):?>
	<div class="dislib">
		<?php echo CHtml::link('> 更多小组话题',array('group/show','gid'=>$group['id'],'page'=>2));?>
	</div>
	<?php endif;}else{?>
	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
	<?php }?>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>