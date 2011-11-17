<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);

Yii::app()->user->setFlash('success','成功信息')
?>

<?php $this->beginWidget('ext.bootstrap.widgets.BootModal',array(
    'id'=>'modal',
    'options'=>array(
        'title'=>'通知',
        'backdropClose'=>false, // close the modal when the backdrop is clicked?
        'escapeClose'=>false, // close the modal when escape is pressed?
        'open'=>true, // should we open the modal on initialization?
        'closeTime'=>350,
        'openTime'=>1000,
        'buttons'=>array(
            array(
                'label'=>'Ok',
                'class'=>'btn  danger',
                'click'=>"js:function() {
                    Alert('hello');
                }",
            ),
            array(
                'label'=>'Cancel',
                'class'=>'btn ',
                'click'=>"js:function() {
                    Alert('byebye');
                }",
            ),
        ),      
    ),
)); ?>
 
123
 
<?php $this->endWidget(); ?>
<h1>联系我们</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id'=>'example-form',
    'stacked'=>false, // should this be a stacked form?
    'errorMessageType'=>'block', // how to display errors, inline or block?
    'enableAjaxValidation'=>false,
)); ?>
 
    <?php echo $form->textFieldBlock($model,'name',array('class'=>'span3')); ?>
    <?php echo $form->textFieldBlock($model,'email',array('class'=>'span3')); ?>
    <?php echo $form->textFieldBlock($model,'subject'); ?>
	<?php echo $form->textAreaBlock($model,'body'); ?>
	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textFieldBlock($model,'verifyCode'); ?>
		<span class="help-block">Please enter the letters as they are shown in the image above.</span>
	</div>
	<?php endif; ?>
    <div class="actions">
        <?php echo BootHtml::submitButton('Submit',array('class'=>'btn danger large')); ?>
    </div>
 
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
