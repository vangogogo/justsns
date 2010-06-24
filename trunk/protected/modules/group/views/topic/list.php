<div class="box1">
	<h3>群话题区(共{$threadCount}条)</h3>
	<table class="ul">
		<tr>
			<th class="c1">话题</th><th class="c2">作者</th><th class="c3">回应/浏览</th><th class="c5">最后回应</th>
		</tr>
		
		<?php if(!empty($threads)){?>
			<?php foreach($threads as $thread):?>
			<tr>
			<td class="OverH">
				<?php if($thread['top']):?><span class="zd">顶</span><?php endif;?>
				<?php if($thread['dist']):?><span class="jh">精</span><?php endif;?>
				<?php echo CHtml::link($thread['title'],array('/group/topic/'.$thread['id'],));?>
			</td>
			<td><?php echo $thread['name']?></td>
			<td><?php echo $thread['postcount']?>/<?php echo $thread['viewcount']?></td>
			<td><?php echo friendlyDate('Y-m-d H:i:s',$thread['replytime'])?></td>
			<?php endforeach;?>
			</tr>
		<?php }else{?>
			
			<tr><td colspan="8">还没有话题，你可以发表话题</td></tr>
		<?php }?>
		
	</table>
	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
	<div class="alR lh30">
		<a href="__APP__/Topic/add/gid/{$gid}">发表话题</a>
		┊<?php echo CHtml::link('进入话题区>>',array('group/discussion','gid'=>$group['id']));?>
	</div>
</div>
