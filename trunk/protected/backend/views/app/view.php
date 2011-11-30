<?php
$this->breadcrumbs=array(
	'Apps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List App','url'=>array('index')),
	array('label'=>'Create App','url'=>array('create')),
	array('label'=>'Update App','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete App','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage App','url'=>array('admin')),
);
?>

<h1>View App #<?php echo $model->id; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'enname',
		'icon',
		'url',
		'url_exp',
		'url_admin',
		'uid_url',
		'add_url',
		'add_name',
		'author',
		'description',
		'order2',
		'place',
		'status',
		'canvas_url',
		'type',
	),
)); ?>
