<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<h1><?php echo UserModule::t("Restore"); ?></h1>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="alert-message warning fade in" data-alert="alert">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $f=$this->beginWidget('UActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
		<?php echo $f->labelEx($form,'login_or_email'); ?>
		<?php echo $f->TextField($form,'login_or_email') ?>
        <?php echo $f->error($form,'login_or_email') ?>
		<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="row submit">
        <label></label>
		<?php echo CHtml::submitButton(UserModule::t("Restore"),array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>
