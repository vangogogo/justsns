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


<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="alert-message warning fade in" data-alert="alert">
        <a class="close" href="#">×</a>
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

<p>
如果你有任何疑问，可以通过一下方式，反馈给我们，谢谢。
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
		
		<?php $this->widget('CCaptcha',array('clickableImage'=>true,'buttonType'=>'link','showRefreshButton'=>true,'buttonLabel'=>'点击更换验证码','imageOptions'=>array('class'=>'fl', 'title'=>'点击图片可更换验证码'),'buttonOptions'=>array('class'=>'refreshvcode fl','tabindex'=>99))); ?>
		<br/>
		<?php echo $form->textField($model,'verifyCode'); ?><?php echo $form->error($model,'verifyCode'); ?>
		<span class="help-block"></span>
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
