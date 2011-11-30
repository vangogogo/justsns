<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'app-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldBlock($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldBlock($model,'enname',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textAreaBlock($model,'icon',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaBlock($model,'url',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaBlock($model,'url_exp',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaBlock($model,'url_admin',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldBlock($model,'uid_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldBlock($model,'add_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldBlock($model,'add_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldBlock($model,'author',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaBlock($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldBlock($model,'order2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldBlock($model,'place',array('class'=>'span5')); ?>

	<?php echo $form->textFieldBlock($model,'status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldBlock($model,'canvas_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldBlock($model,'type',array('class'=>'span5')); ?>

	<div class="actions">
		<?php echo BootHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
