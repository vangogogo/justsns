<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    #'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'title'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>

    <?php echo CHtml::errorSummary($model);?>
    <?php echo $form->error($model,'content'); ?>

    <?php echo $form->textArea($model,'content',array('class'=>'reply_form'));?>
    <?php echo $form->hiddenField($model,'gid');?>
    <?php echo $form->hiddenField($model,'tid');?>
    <br/>
    <?php echo CHtml::submitButton('加上去',array('class'=>'btn_b')); ?>
<?php $this->endWidget();?>
