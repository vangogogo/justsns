<table class=".zebra-striped">
	<tr>
		<th>话题</th>
		<?php if(!isset($no_group)):?><th width="100">小组</th><?php endif;?>
		<?php if(!isset($no_author)):?><th width="90">作者</th><?php endif;?>
		<th width="36" nowrap="nowrap">回应</th>
		<th width="80" class="alignr" nowrap="nowrap">最后回应</th>
	</tr>
	<?php foreach($threads as $topic):?>
	<tr>
		<td>
			<?php if($topic['top']):?><span class="label warning">顶</span><?php endif;?>
			<?php if($topic['dist']):?><span class="label important">精</span><?php endif;?>
			<?php echo CHtml::link(YiicmsHelper::cutString($topic['title'],22),array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']));?>
		</td>
		<?php if(!isset($no_group)):?>
		<td>
			<?php echo CHtml::link($topic->group->name,array('/group/group/show','gid'=>$topic['gid']));?>
		</td>
		<?php endif;?>
		<?php if(!isset($no_author)):?>
		<td>
			<?php echo CHtml::link($topic->user->username,array('/space/index','uid'=>$topic['uid']));?>
		</td>
		<?php endif;?>
		<td>
			<?php if($topic['postcount'] > 0) echo $topic['postcount']?>
		</td>
		<td align="right">
			<span class="color02"><?php echo YiicmsHelper::friendlyDate('m-d H:i',$topic['replytime']?$topic['replytime']:$topic['ctime'])?></span>
		</td>
	</tr>
	<?php endforeach;?>
</table>
