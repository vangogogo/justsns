<?php
	include('_top.php');
?>
<?php
	echo EHtml::beginForm();
	EHtml::setOptions(array(
	
		//'errorLabelContainer' 	=> 'div.container ul',
		//'errorContainer'		=> 'div.container',
		'errorElement'			=> "div",
		//'wrapper' 				=> 'li',
		'errorClass' 			=> 'error',
		//错误提示
		//'errorPlacement' => 'function(error, element) {Alert(error);}',

		'keyup' 				=> false,
		'focusout'				=> true,
		'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);}'
	));
?>
<div class="BlogBox">
	<div class="MList" style="width:640px;"><!-- 写短消息 begin  -->
		<div class="mt10 f14px lh30 cGray2"><strong>发送私密对话</strong></div>
			<ul>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;"><strong>发送给：</strong></div>
					<div class="left" style="width: 408px;">
						<?php if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?>
						<!--<input type="text" class="TextH20" style="width:70%" onBlur="this.className='TextH20'" onFocus="this.className='Text2'"/>-->
					</div>
				</li>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;"><strong>主题</strong>：</div>
					<div class="left" style="width: 90%;">
						<?php echo EHtml::activeTextField($model,'subject',array('class'=>'TextH20'));?>
					</div>
				</li>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;">内容：</div>
					<div class="left" style="width: 90%;">
						<?php echo EHtml::activeTextArea($model,'content',array('class'=>'Text'));?>
					</div>
				</li>
				<li>
					<div class="left lh25 fB" style="width: 10%;">&nbsp;</div>
					<div class="left" style="width: 90%;">
						<?php echo EHtml::submitButton('发送',array('class'=>'btn_b')); ?>
						<input type="button" class="btn_w" onclick="history.back(-1);"value="取 消" />
					</div>
				</li>
			</ul>
	</div>
	<!-- 发短消息 end  -->
</div>
<?php echo EHtml::endForm(); ?>
