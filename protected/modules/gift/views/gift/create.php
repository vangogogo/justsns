<div class="wenhou">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
			<div class="row">
                <label class="left">接收人：</label>
				<div style="width:300px" class="left"><?php $this->widget('WFriendSelect'); ?></div>
			</div>
            <div class="clear"></div>
            <div class="row ">
		<div class="wenhouDIV giftblock"><ul><?php if(!empty($gifts)) { ?> <?php if(is_array($gifts)) { foreach($gifts as $key => $value) { ?>
		<li>
			<label for="greeting_ids[<?php echo $value->id?>]"><?php echo CHtml::image($this->image_dir.$value->img,$value->name,array('title'=>$value->desc));?></label>
            <br/>
			<input id="greeting_ids[<?php echo $value->id?>]"
				name="gift_ids[<?php echo $value->id?>]" type="checkbox"
				value="<?php echo $value->id?>" /></li>

		<?php } } ?> <?php } ?></ul>
		<div class="clear"></div>

        </div>
		<div class="baikeUserPage"><?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
		</div>
    </div>
			<div class="row">
				<h2 class="f14px fB lh30">附加消息</h2>
				<p style="margin:0; padding:0;">
					不能超过200个字符
				</p>
				<?php echo $form->textArea($model, 'content', array('class'=>'t_input t_area','id'=>'sendInfo'));?>
			</div>

			<div class="row2">
				<?php echo $form->radioButtonList($model,'access',$this->accessOptions,array('separator'=>'<br/>')); ?>
			</div>
            <div class="row">
				<input type="submit" class="btn" style="margin-right:5px;" value="赠送礼物" /><input type="button" class="btn" value="取消" />
			</div>
<?php $this->endWidget(); ?>
</div>
