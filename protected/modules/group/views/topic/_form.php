<h1><?php echo $group['name']?>发言</h1>
<div class="grid_15 suffix_1">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'focus'=>array($model,'title'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
         ),
    )); ?>
    <?php echo CHtml::errorSummary($model);?>
    <?php echo $form->error($model,'title'); ?>
    <?php echo $form->error($model,'content'); ?>
    <div class="form">
	    <div class="row">
		    <?php echo $form->labelEx($model,'title'); ?>
		    <?php echo $form->textField($model,'title',array('class'=>'t_input')); ?>
            <?php #echo $form->error($model,'title'); ?>
	    </div>
	    <div class="row">
		    <label></label>
		    <?php echo $form->textArea($model,'content',array('class'=>'t_input t_area')); ?>
            
	    </div>
	    <div class="row">
            <label></label>
        <?php echo CHtml::submitButton('提交信息',array('class'=>'btn'));?>
	    </div>
    </div>
    <?php $this->endWidget();?>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
