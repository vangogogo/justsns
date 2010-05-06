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
			'errorClass' 			=> 'invalid',
			
			//错误提示
			'errorPlacement' => 'function(error, element) {element.parents("li").find("div.error_info").show(); var error_label = element.parent("div").next("div").find(".clue p");error.appendTo(error_label);}',
			//正确显示
			'success'=>'function(label) { label.parents("div.error_info").hide().prev(".success").show();}',
			'keyup' 				=> false,
			'focusout' 				=> true,
			
			'highlight' 			=> '
				function(element,errorClass){

			       		$(element).addClass("invalid");
			       		$(element).parents("li").find("div.error_info").show().prev(".success").hide();					
			}',
			'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);}'
		));
		
?>
<div class="data jsvform" style="padding-top:30px;"><!-- 修改密码 begin  -->
<?php echo EHtml::errorSummary($form);?>
	<div style="padding: 10px 0px;" class="lh18 alC border cGray2">
		为了更好地保护你的账户安全，需要验证你拥有这个Email地址。
		<br/>
		我们会向你的新Email地址发送一封电子邮件，请单击电子邮件正文中的链接或按照说明操作。
	</div>
	<ul>
		<li>
			<div class="cl">旧Email：<em>*</em></div>
			<div class="cc">
				<?php echo Yii::app()->user->email;?>
			</div>
			<div class="c"></div>
		</li>
		<li>
			<div class="cl">新email：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeTextField($form,'email',array('class'=>'t_input','value'=>$form->email)); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue"><p class="error_content"></p><span class="clue_btm"></span></div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</li>
		<?php if(1){ ?>
		<li>
			<div class="cl">验证码：<em>*</em></div>
			<div class="cc">
				<?php $this->widget('CCaptcha'); ?><br/>
				<?php echo EHtml::activeTextField($form,'verifyCode',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue"><p class="error_content"></p><span class="clue_btm"></span></div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</li>
		<?php } ?>
		<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
			<?php echo CHtml::submitButton('确认修改',array('class'=>'btn_b')); ?>
			</div><div class="cr"></div>
			<div class="c"></div>
		</li>
	</ul>
</div><!-- 修改密码 end  -->
<?php echo EHtml::endForm(); ?>
