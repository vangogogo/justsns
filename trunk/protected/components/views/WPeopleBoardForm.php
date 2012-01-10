<!-- 留言板 -->
<?php YiicmsHelper::_cklogin();?>
<?php $form = $this->beginWidget('BootActiveForm', array(
    'id'=>$htmlOptions['id'],
    'action'=>$action,
    #'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    #'focus'=>array($model,'content'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>
<input type="hidden" value="<?php echo $refer?>" name="refer">
	<input type="hidden" value="<?php echo $formhash;?>" name="formhash">
    <?php echo $form->hiddenField($model,'object_id');?>
    <?php echo $form->hiddenField($model,'object_type');?>
	<div class="row">
	<?php echo $form->textArea($model,'board_content',array('class'=>'t_input t_area reply_form','style'=>"height:40px;" ));?>
    <?php echo CHtml::errorSummary($model);?>
    <?php echo $form->error($model,'content'); ?>
    </div>
    <?php echo CHtml::submitButton('加上去',array('class'=>'btn')); ?>
<?php $this->endWidget();?>
<!-- 留言板 -->