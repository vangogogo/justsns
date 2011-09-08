<h1><?php echo UserModule::t('Your profile'); ?></h1>
    <?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="successMessage">
	    <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
    <?php endif; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>


	<?php #echo $form->errorSummary(array($model,$profile)); ?>

	<div class="row">
		<?php echo $form->label($profile,'name'); ?>
		<?php echo $form->textField($profile,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
        <?php if(!empty($model->email)):?>
		<?php echo $model->email; ?> <?php #echo CHtml::link('修改',array('editEmail'));?>
        <?php else:?>
        <?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>20)); ?>
        <?php endif;?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'location'); ?>
		<?php echo $form->textField($profile,'location'); ?>
		<?php echo $form->error($profile,'location'); ?>
	</div>

	<div class="row">
		<label> </label>
        <?php $this->widget('ext.yii-gravatar.YiiGravatar', array(
            'email'=>$model->email,
            'size'=>80,
            'defaultImage'=>'http://www.amsn-project.net/images/download-linux.png',
            'secure'=>false,
            'rating'=>'r',
            'emailHashed'=>false,
            'htmlOptions'=>array(
                'alt'=>'Gravatar image',
                'title'=>'Gravatar image',
            )
        )); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		 <?php echo CHtml::link('修改密码',array('Profile/Changepassword'));?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
        <label></label>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
