<?php
		$CS=Yii::app()->jformvalidate;
		echo $CS->beginForm();
		$CS->setScenario($model->scenario);
		$CS->setOptions(array(
		
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
<?php echo CHtml::errorSummary($model);?>
	<div class="confirm">
		<br/>
		分组的名称：<?php echo $CS->activeTextField($model,'name',array('class'=>'Text'));?>
	</div>
	
	<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
	</div>
<?php echo $CS->endForm(); ?> 
