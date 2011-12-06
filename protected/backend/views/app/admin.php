<?php
$this->breadcrumbs=array(
	'Apps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List App','url'=>array('index')),
	array('label'=>'Create App','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('app-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Apps</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'app-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'enname',
		'icon',
		'url',
		'url_exp',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
