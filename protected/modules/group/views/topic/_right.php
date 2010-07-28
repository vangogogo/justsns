<div id="topicmain_r">
	<h2><?php echo CHtml::link('> 小组首页',array('/group'));?></h2>
	<br/>
	<h2><?php echo CHtml::link('回'.$group['name'].'小组',array('/group/group/show','gid'=>$topic['gid']));?></h2>
	<br/>
	<br/>
	<?php if(!empty($new_topics)):?>
	<h2>本组最近其他话题</h2>
	<div id="maincon_rl1">
		<ul>
			<?php foreach($new_topics as $topic):?>
			<li>
				<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']))?>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<br/>
	<?php endif ?>
</div>