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




	    <div class="clearfix">

		
                <div style="margin:0 38px 0 0;position: absolute;left 20px; width: 80px;">
				<?php $this->widget('WUserFace', array('uid'=>$model->toUserId)); ?></div>

        <?php if(!empty($model->toUserId)):?>
            <?php echo $form->hiddenField($model,'toUserId'); ?>
				<label>发送给</label>
                
			<div class="input">
              <div class="input-prepend">
                <span class="add-on">@</span>
                <input class="medium  disabled" disabled id="prependedInput" name="" size="8" type="text" value="<?php echo $toUserName;?>">
              </div>

            </div>



        <?php else:?>

	        <?php #if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?>

        <?php endif;?>
	    </div>
			<?php echo $form->textFieldRow($model,'subject',array('class'=>'span3')); ?>

			<?php echo $form->textAreaRow($model,'content',array('class'=>'span8','row'=>5)); ?>

	    <div class="row submit">
            <label></label>
		    <?php echo CHtml::submitButton('发送',array('class'=>'btn')); ?>
            <input type="button" class="btn_w" onclick="history.back(-1);"value="取消" />
	    </div>

	<!-- 发短消息 end  -->
    <?php $this->endWidget(); ?>
