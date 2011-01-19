<div class="grid_16">
	<?php if(!empty($new_groups)):?>
	<h2>最活跃的小组 ······</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$new_groups));?>
	<br/>
	<br/>
	<?php endif;?>
	<h2>小组的最近话题 ······</h2>
	<table class="disli">
		<tr>
			<td>
				话题
			</td>
			<td>
				小组
			</td>
			<td>
				作者
			</td>
			<td width="36">
				回应
			</td>
			<td width="110" align=right>
				最后回应
			</td>
		</tr>
		<?php foreach($threads as $topic):?>
		<tr>
			<td>
				<?php if($topic['top']):?><span class="zd">顶</span><?php endif;?>
				<?php if($topic['dist']):?><span class="jh">精</span><?php endif;?>
				<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']));?>
			</td>
			<td>
				<?php echo CHtml::link($topic['group_name'],array('/group/group/show','gid'=>$topic['gid']));?>
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
	</table>
	<div class="height01">
	</div>
	<div class="dislib">
		<a href="/group/list.html">&gt; 更多话题</a>
	</div>
	<br/>
	<br/>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>