<table class="disli">
	<tr>
		<td>
			话题
		</td>
		<?php if(isset($no_group)):?>
		<td>
			小组
		</td>
		<?php endif;?>
		<?php if(isset($no_author)):?>
		<td>
			作者
		</td>
		<?php endif;?>
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
		<?php if(isset($no_group)):?>
		<td>
			<?php echo CHtml::link($topic['group_name'],array('/group/group/show','gid'=>$topic['gid']));?>
		</td>
		<?php endif;?>
		<?php if(isset($no_author)):?>
		<td>
			<?php echo CHtml::link($topic['name'],array('/space','uid'=>$topic['uid']));?>
		</td>
		<?php endif;?>
		<td>
			<?php echo $topic['postcount']?>
		</td>
		<td align="right">
			<span class="color02"><?php echo friendlyDate('m-d H:i',$topic['replytime'])?></span>
		</td>
	</tr>
	<?php endforeach;?>
</table>