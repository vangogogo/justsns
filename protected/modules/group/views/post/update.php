<h2>Update GroupPost <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('GroupPost List',array('list')); ?>]
[<?php echo CHtml::link('New GroupPost',array('create')); ?>]
[<?php echo CHtml::link('Manage GroupPost',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>