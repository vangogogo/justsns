<div id="grouplist" <?php echo "class='$class'"?>>
	<ul>
		<?php foreach($group_list as $group):?>
		<li>
			<div id="image">
				<?php echo CHtml::link('123456',array('/group/group/show','gid'=>$group['id']));?>
			</div>
				<?php echo CHtml::link($group['name'],array('/group/group/show','gid'=>$group['id']));?>
			(<?php echo CHtml::encode($group['threadcount'])?>)
		</li>
		<?php endforeach;?>
	</ul>
</div>