    <h2><?php echo CHtml::link('> 回'.$group['name'].'小组',array('/group/group/show','gid'=>$group['id']));?></h2>
	<h2><?php echo CHtml::link('> 发起话题',array('topic/create','gid'=>$group['id']));?></h2>
	<h2><?php echo CHtml::link('> 浏览所有成员',array('/group/group/members','gid'=>$group['id']));?> (<?php echo $group['membercount']?>)</h2>
    <br/>
	<h2><?php echo CHtml::link('> 小组设置',array('/group/group/update','gid'=>$group['id']));?></h2>

	<?php if(!empty($group_list)):?>
	<h2>本小组油条还喜欢去</h2>
	<?php $this->renderPartial('_group_list',array('group_list'=>$group_list));?>
	<br/>
	<?php endif;?>
