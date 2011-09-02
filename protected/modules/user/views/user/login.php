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
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>


	<?php #echo CHtml::errorSummary($model,' ',' '); ?>
	
	<div class="row">
	    <?php echo $form->labelEx($model,'username'); ?>
	    <?php echo $form->textField($model,'username',array('class'=>'t_input')); ?>
	    <?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('class'=>'t_input')); ?>
	<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row rememberMe">
        <label></label>
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe',array('class'=>'rememberMe')); ?>
		<?php #echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
	</div>

	<div class="row submit">
        <label></label>
		<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'btn')); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
