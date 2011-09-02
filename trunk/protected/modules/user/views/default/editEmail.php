<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="row">
		<?php echo $form->labelEx($profile,'name'); ?>
		<?php echo $form->textField($profile,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'location'); ?>
		<?php echo $form->textField($profile,'location',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($profile,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $model->email; ?> <?php echo CHtml::link('修改',array('editEmail'));?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		 <?php echo CHtml::link('修改密码',array('editPassword'));?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
