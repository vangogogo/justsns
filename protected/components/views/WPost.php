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
<?php /*$this->widget('application.extensions.ckeditor.CKEditor', array(
	'model'=>$model,
	'name'=>'content',
	'language'=>Yii::app()->language,
	'editorTemplate'=>'basic',
	'skin'=>'v2',
));*/ ?>
<?php echo EHtml::errorSummary($model);?>
<?php echo EHtml::activeTextArea($model,'content');?>
<br/>
<?php echo EHtml::activeHiddenField($model,'gid');?>
<?php echo EHtml::activeHiddenField($model,'tid');?>


		<?php 
		echo EHtml::ajaxSubmitButton('发送',Yii::app()->createUrl('group/topic/doAddPost'),
			array(
				'beforeSend' => 'AjaxBeforeSend',
				// uncomment to enable onComplete handler
				'success' => 'AjaxSuccess',
				'update'=> '#response'),
			array('id'=> 'nicestuff','class'=>'ui-state-default ui-corner-all')
		);  
		?>
		
<?php echo EHtml::endForm(); ?>