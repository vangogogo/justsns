    <?php include('_top.php');?>

    <?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'user-form',
	    'enableAjaxValidation'=>true,
	    #'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	    'clientOptions'=>array(
		    'validateOnSubmit'=>true,
	    ),
	    #'htmlOptions' => array('enctype'=>'multipart/form-data'),
    )); ?>
    <!-- 写短消息 begin  -->
    <div class="MList">

        <?php if(!empty($model->toUserId)):?>
            <?php echo $form->hiddenField($model,'toUserId'); ?>
	        <div class="row">
                <label>发送给</label>
                <span><?php echo $toUserName;?></span>

                <?php $this->widget('WUserFace', array('uid'=>$model->toUserId)); ?>

	        </div>
        <?php else:?>
	    <div class="row">
	        <?php #if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?>
	    </div>
        <?php endif;?>

	    <div class="row">
	        <?php echo $form->labelEx($model,'subject'); ?>
	        <?php echo $form->textField($model,'subject',array('class'=>'t_input')); ?>
	        <?php echo $form->error($model,'subject'); ?>
	    </div>
	
	    <div class="row">
            <label></label>
	        <?php echo $form->textarea($model,'content',array('class'=>'t_input t_area')); ?><br/>
	        <label></label><?php echo $form->error($model,'content'); ?>
	    </div>

	    <div class="row submit">
            <label></label>
		    <?php echo CHtml::submitButton('发送',array('class'=>'btn')); ?>
            <input type="button" class="btn_w" onclick="history.back(-1);"value="取 消" />
	    </div>
    </div>
	<!-- 发短消息 end  -->
    <?php $this->endWidget(); ?>
