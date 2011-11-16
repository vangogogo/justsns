<?php
		echo EHtml::beginForm();
		EHtml::setOptions(array(
		
			//'errorLabelContainer' 	=> 'div.container ul',
			//'errorContainer'		=> 'div.container',
			'errorElement'			=> "div",
			//'wrapper' 				=> 'li',
			'errorClass' 			=> 'invalid',

			'keyup' 				=> true,
			'focusout' 				=> true,
			'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);}'
		));
		
?>
<?php echo EHtml::errorSummary($model);?>
	<div class="confirm">
		<br/>
		分组的名称：<?php echo EHtml::activeTextField($model,'name',array('class'=>'Text'));?>
	</div>
	
	<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
	</div>
<?php echo EHtml::endForm(); ?> 

<script>
    
</script>
