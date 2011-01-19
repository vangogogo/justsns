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
	<table class="disli">
		<tr>
			<td>
				话题
			</td>
			<td width="120">
				作者
			</td>
			<td width="36">
				回应
			</td>
			<td width="110" align=right>
				最后回应
			</td>
		</tr>
		<?php if(!empty($threads)){?>
			<?php foreach($threads as $topic):?>
		<tr>
			<td>
				<?php if($topic['top']):?><span class="zd">顶</span><?php endif;?>
				<?php if($topic['dist']):?><span class="jh">精</span><?php endif;?>
				<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']));?>
			</td>
			<td>
				<?php echo CHtml::link($topic['name'],array('/space','uid'=>$topic['uid']));?>
			</td>
			<td>
				<?php echo $topic['postcount']?>/<?php echo $topic['viewcount']?>
			</td>
			<td align="right">
				<span class="color02"><?php echo friendlyDate('m-d H:i',$topic['replytime'])?></span>
			</td>
		</tr>
			<?php endforeach;?>
		<?php }else{?>
			
			<tr><td colspan="8">还没有话题，你可以发表话题</td></tr>
		<?php }?>

	</table>
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