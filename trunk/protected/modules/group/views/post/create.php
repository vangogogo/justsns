<h2>New GroupPost</h2>

<div class="actionBar">
[<?php echo CHtml::link('GroupPost List',array('list')); ?>]
[<?php echo CHtml::link('Manage GroupPost',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>