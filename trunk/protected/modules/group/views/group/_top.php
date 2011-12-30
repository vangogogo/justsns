<?php if($this->module->isGroupAdmin):?>
	<!-- 切换标签 begin  -->
	<div class="tab-menu">
	<?php
	$items =array(
		array('label'=>'<span>基本信息</span>', 'url'=>array('/group/group/update','gid'=>$group->primaryKey)),
		array('label'=>'<span>成员管理</span>', 'url'=>array('/group/group/members','gid'=>$group->primaryKey)),
	);
	$this->widget('ext.bootstrap.widgets.menu.BootTabs',array(
		'items'=>$items,
		#'activeCssClass'=>'on',
		'encodeLabel'=>false,
	));
	?>
	</div>
<?php endif;?>