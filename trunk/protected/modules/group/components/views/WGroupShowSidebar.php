	<h2><?php echo CHtml::link('> 小组首页',array('/group'));?></h2>
	<h2><?php echo CHtml::link('> 发起话题',array('topic/create','gid'=>$group['id']));?></h2>
	<h2><?php echo CHtml::link('> 浏览所有成员',array('group/member','gid'=>$group['id']));?> (<?php echo $group['membercount']?>)</h2>
	<h2><?php echo CHtml::link('> 退出小组',array('group/outGroup','gid'=>$group['id']));?></h2>
	<h2><?php echo CHtml::link('> 加入该小组',array('group/outGroup','gid'=>$group['id']));?></h2>
	<?php if(!empty($group_list)):?>
	<h2>本小组油条还喜欢去</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$group_list));?>
	<br/>
	<?php endif;?>