<h1><?php echo $group['name']?>发言</h1>
<div class="grid_15 suffix_1">
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
	<?php echo EHtml::errorSummary($model);?>
    <div class="form">
		<div class="row">
            <?php echo EHtml::activeLabelEx($model,'title'); ?>
			<?php echo EHtml::activeTextField($model,'title',array('class'=>'t_input')); ?>
		</div>
		<div class="row">
			<?php echo EHtml::activeTextArea($model,'content_temp',array('class'=>'t_input t_area')); ?>
		</div>
		<div class="row">
            <?php echo CHtml::submitButton('确认',array('class'=>'btn_b')); ?>
		</div>
    </div>
<?php echo EHtml::endForm();?>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
