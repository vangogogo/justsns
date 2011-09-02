<h2><?php echo CHtml::link('> 小组首页',array('/group'));?></h2>
<h2><?php echo CHtml::link('> 回'.$group['name'].'小组',array('/group/group/show','gid'=>$group['id']));?></h2>
<?php if(!empty($new_topics)):?>
<h2>本组最近其他话题</h2>
<div class="sidebar">
	<ul>
		<?php foreach($new_topics as $topic):?>
		<li>
			<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']))?>
			<span class="pl"> (<?php echo User::model()->getUserName($topic['uid']);?>)</span>
		</li>
		<?php endforeach;?>
	</ul>
</div>
<br/>
<?php endif ?>