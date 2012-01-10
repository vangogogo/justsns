<?php $form = $this->beginWidget('BootActiveForm', array(
    'id'=>'user-form',
    'action'=>array('/group/topic/addPost','tid'=>$model->tid),
    #'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    #'focus'=>array($model,'content'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>
    <?php echo $form->textArea($model,'content',array('class'=>'t_input t_area reply_form'));?>
    <?php echo $form->hiddenField($model,'gid');?>
    <?php echo $form->hiddenField($model,'tid');?>
	<div class="row">
    <?php echo CHtml::errorSummary($model);?>
    <?php echo $form->error($model,'content'); ?>
    </div>
    <?php echo CHtml::submitButton('加上去',array('class'=>'btn')); ?>
<?php $this->endWidget();?>
