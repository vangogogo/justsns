<?php if(!empty($msg)) :?>
	<?php echo $msg;?>
<?php else:?>

<?php $form=$this->beginWidget('BootActiveForm', array(
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
		<div class="span1x5">
			<?php $this->widget('WUserFace', array('uid'=>$model->fuid)); ?>
		</div>
		<div class="span7">
			<div class="row">
				<?php echo $form->textArea($model,'note',array('class'=>'t_input t_area'));?>
			</div>
		    <?php echo CHtml::submitButton('加为好友',array('class'=>'btn')); ?>
			<input type="button" class="btn btn_w btn_cancal" value="取 消" />
		</div>
	</div>
	<?php $this->endWidget(); ?>
<?php endif;?>