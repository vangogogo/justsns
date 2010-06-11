<?php include('_top.php');?>
<?php
	echo EHtml::beginForm(); 
	EHtml::setOptions(array(
	
		//'errorLabelContainer'	=> 'div.container ul',
		//'errorContainer'		=> 'div.container',
		'errorElement'			=> 'div',
		//'wrapper'				=> 'li',
		'errorClass'			=> 'invalid',
		
		//错误提示
		'errorPlacement'		=> 'function(error, element) {element.parents("li").find("div.error_info").show(); var error_label = element.parent("div").next("div").find(".clue p");error.appendTo(error_label);}',
		//正确显示
		'success'				=> 'function(label) { label.parents("div.error_info").hide().prev(".success").show();}',
		'keyup'					=> false,
		'focusout'				=> true,
		
		'highlight'				=> '
			function(element,errorClass){

		       		$(element).addClass("invalid");
		       		$(element).parents("li").find("div.error_info").show().prev(".success").hide();					
		}',
		'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);}'
	));
?>
<!-- 修改密码 begin  -->
<div class="data jsvform" style="padding-top:30px;">
	<?php echo EHtml::errorSummary($form);?>
	<ul>
		<li>
			<div class="cl">
				当前密码：<em>*</em>
			</div>
			<div class="cc">
				<?php echo EHtml::activePasswordField($form,'oldpassword',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue">
							<p class="error_content">
							</p>
							<span class="clue_btm"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="c">
			</div>
		</li>
		<li>
			<div class="cl">
				新密码：<em>*</em>
			</div>
			<div class="cc">
				<?php echo EHtml::activePasswordField($form,'password',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue">
							<p class="error_content">
							</p>
							<span class="clue_btm"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="c">
			</div>
		</li>
		<li>
			<div class="cl">
				再输入一遍密码：<em>*</em>
			</div>
			<div class="cc">
				<?php echo EHtml::activePasswordField($form,'repassword',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue">
							<p class="error_content">
							</p>
							<span class="clue_btm"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="c">
			</div>
		</li>
		<li>
			<div class="cl">
				<em>&nbsp;</em>
			</div>
			<div class="cc">
				<?php echo CHtml::submitButton('确认修改',array('class'=>'btn_b')); ?>
			</div>
			<div class="cr">
			</div>
			<div class="c">
			</div>
		</li>
	</ul>
</div>
<!-- 修改密码 end  -->
<?php echo EHtml::endForm();?>
