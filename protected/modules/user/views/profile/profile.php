<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),

);
?>

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

   		 <?php echo CHtml::link('更改',array('profile/ChangeEmail'));?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($profile,'location'); ?>
		<?php echo $form->textField($profile,'location'); ?>
		<?php echo $form->error($profile,'location'); ?>
	</div>
	<?php /*
	<div class="row">
		<label> &nbsp</label>
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
	*/ ?>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		 <?php echo CHtml::link('修改密码',array('profile/Changepassword'));?>
		<?php echo $form->error($model,'password'); ?>
	</div>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
                if($field->varname != 'astro_id') continue;
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>
			<?php
			}
		}
?>
	<div class="row buttons">
        <label></label>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
