<div class="grid_16">
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

<?php echo EHtml::errorSummary($form);?>
	<ul>
		<li>
			<div class="cl">标题：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeTextField($form,'title',array('class'=>'t_input')); ?>
			</div>
			<div class="c"></div>
		</li>
		<li>
			<div class="cl">内容：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeTextArea($form,'content_temp',array('class'=>'t_input')); ?>
			</div>
			<div class="c"></div>
		</li>
		<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
			<?php echo CHtml::submitButton('确认',array('class'=>'btn_b')); ?>
			</div><div class="cr"></div>
			<div class="c"></div>
		</li>
	</ul>
</div><!-- 修改密码 end  -->
<?php echo EHtml::endForm();?>

<div class="grid_8">
	<?php require '_right.php';?>
</div>