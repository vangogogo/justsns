<div class="grid_16">
	<?php if(!empty($msg)) {		echo $msg;?>

	<?php }else{?>	
	<div class="con">
    <?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'user-form',
	    'enableAjaxValidation'=>true,
	    #'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	    'clientOptions'=>array(
		    'validateOnSubmit'=>true,
	    ),
	    #'htmlOptions' => array('enctype'=>'multipart/form-data'),
    )); ?>

		<?php echo $form->hiddenField($model,'fuid'); ?>

        <div class="row">
            <?php $this->widget('WUserFace', array('uid'=>$model->fuid)); ?>
        </div>
        <div class="row">
			<?php echo $form->textArea($model,'note',array('class'=>'t_input t_area'));?>
        </div>

	    <div class="row submit">
            <label></label>
		    <?php echo CHtml::submitButton('加为好友',array('class'=>'btn')); ?>
            <input type="button" class="btn_w" value="取 消" />
	    </div>

    <?php $this->endWidget(); ?>
		</div>
	<?php }?>	
</div>
