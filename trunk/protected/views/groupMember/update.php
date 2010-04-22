<?php
$this->breadcrumbs=array(
	'Group Members'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupMember', 'url'=>array('index')),
	array('label'=>'Create GroupMember', 'url'=>array('create')),
	array('label'=>'View GroupMember', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupMember', 'url'=>array('admin')),
);
?>

<h1>Update GroupMember <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>