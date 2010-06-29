<h2>View GroupPost <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('GroupPost List',array('list')); ?>]
[<?php echo CHtml::link('New GroupPost',array('create')); ?>]
[<?php echo CHtml::link('Update GroupPost',array('update','id'=>$model->id)); ?>]
[<?php echo CHtml::linkButton('Delete GroupPost',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage GroupPost',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('gid')); ?>
</th>
    <td><?php echo CHtml::encode($model->gid); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('uid')); ?>
</th>
    <td><?php echo CHtml::encode($model->uid); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tid')); ?>
</th>
    <td><?php echo CHtml::encode($model->tid); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('content')); ?>
</th>
    <td><?php echo CHtml::encode($model->content); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('ip')); ?>
</th>
    <td><?php echo CHtml::encode($model->ip); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('istopic')); ?>
</th>
    <td><?php echo CHtml::encode($model->istopic); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('ctime')); ?>
</th>
    <td><?php echo CHtml::encode($model->ctime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>
</th>
    <td><?php echo CHtml::encode($model->status); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('quote')); ?>
</th>
    <td><?php echo CHtml::encode($model->quote); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('is_del')); ?>
</th>
    <td><?php echo CHtml::encode($model->is_del); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('attach')); ?>
</th>
    <td><?php echo CHtml::encode($model->attach); ?>
</td>
</tr>
</table>
