<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php #echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
<?php $form=$this->beginWidget('BootActiveForm', array(
    'id'=>'login-form',
    'stacked'=>false, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
    'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
 
 <?php echo $form->errorSummary($model); ?>
 
    <?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>
    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
    <?php echo $form->checkBoxRow($model,'rememberMe'); ?>

    <div class="actions">
        <?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'btn primary large')); ?>
 <?php #echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>


    </div>
 
<?php $this->endWidget(); ?>

</div><!-- form -->

 <a href="<?php echo Yii::app()->createUrl('/user/weibo/login')?>"><img src="/images/weibo_login_btn.png" alt="用新浪微博帐号登录"></a>
