<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);


?>

<div class="page-header">
	<h1>联系我们 <small>Contact US</small></h1>
</div>

<div class="content">


<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>



<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id'=>'user-form',
    'stacked'=>false, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
    'enableAjaxValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>
<div class="form">
	<div class="row">
    <?php echo $form->textFieldBlock($model,'name'); ?>
    <?php echo $form->textFieldBlock($model,'email'); ?>
    <?php echo $form->textFieldBlock($model,'subject'); ?>
	<?php echo $form->textAreaBlock($model,'body',array('class'=>'t_area')); ?>
	</div>
	<?php if(extension_loaded('gd')): ?>
	<div class="row captcha-item">
		<?php echo $form->labelEx($model,'verifyCode'); ?>


		<div class="input">
		
		<?php $this->widget('CCaptcha'); ?>
		<br/>
		<?php echo $form->textField($model,'verifyCode'); ?><?php echo $form->error($model,'verifyCode'); ?>
		<span class="help-block">Here's some help text</span>
		</div>
	</div>

	<?php endif; ?>
    <div class="actions">
        <?php echo BootHtml::submitButton('发送',array('class'=>'btn danger large')); ?>
    </div>
</div><!-- form -->
<?php $this->endWidget(); ?>



<?php endif; ?>

	</div>
<div class="sidebar">
	<h3>Secondary content</h3>
</div>