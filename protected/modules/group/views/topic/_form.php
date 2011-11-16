<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    #'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    #'focus'=>array($model,'title'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>
<?php echo CHtml::errorSummary($model);?>
<div class="form">
    <div class="row">
	    <?php echo $form->labelEx($model,'title'); ?>
	    <?php echo $form->textField($model,'title',array('class'=>'t_input')); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>
    <div class="row">
	    <label></label>
	    <?php echo $form->textArea($model,'content',array('class'=>'t_input t_area')); ?>
	    <label></label>    <?php echo $form->error($model,'content'); ?>
    </div>
    <div class="row">
        <label></label>
    <?php echo CHtml::submitButton('发布',array('class'=>'btn'));?>
    <input type="button" class="btn_w" onclick="history.back(-1);"value="取消" />
    </div>
</div>
<?php $this->endWidget();?>

