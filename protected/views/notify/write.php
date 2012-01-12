<?php include('_top.php');?>

<?php $form=$this->beginWidget('BootActiveForm', array(
    'id'=>'user-form',
    'stacked'=>false, // should this be a stacked form?
    'errorMessageType'=>'block', // how to display errors, inline or block?
	'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <!-- 写短消息 begin  -->
    <?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="span1x5">
			<?php $this->widget('WUserFace', array('uid'=>$model->toUserId)); ?>
		</div>
		<div class="span9">
        <?php if(!empty($model->toUserId)):?>
			<?php echo $form->hiddenField($model,'toUserId'); ?>
			
			<div class="clearfix">
				<label>发送给</label>
				<div class="input-prepend">
					<span class="add-on">@</span>
					<input class="medium  disabled"	disabled id="prependedInput" name="" size="8" type="text" value="<?php echo $toUserName;?>">
				</div>
			</div>
        <?php else:?>
	        <?php #if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?>
        <?php endif;?>
        
		<?php echo $form->textFieldRow($model,'subject',array('class'=>'span3')); ?>
		<?php echo $form->textAreaRow($model,'content',array('class'=>'t_input t_area','row'=>5)); ?>
		
	    <label></label><?php echo CHtml::submitButton('发送',array('class'=>'btn')); ?>
		<input type="button" class="btn btn_w" onclick="history.back(-1);"value="取消" />
		</div>
    </div>
<?php $this->endWidget(); ?>
<!-- 发短消息 end  -->