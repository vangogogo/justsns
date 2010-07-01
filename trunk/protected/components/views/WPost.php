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

<style type="text/css">
		.toggler { width: 500px; height: 200px; }
		#button { padding: .5em 1em; text-decoration: none; }
		#effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
		#effect h3 { margin: 0; padding: 0.4em; text-align: center; }
		
#ajax-show {

border:4px solid #CCCCCC;
font-size:12px;
height:auto;
position:fixed;
right:1px;
top:1px;
width:180px;
}		
	</style>
	
	<script type="text/javascript">
	showloading('<p class="loadingbar">数据读取中 请稍候...</p>');

	</script>


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
				'beforeSend' => 'myBeforeSend',
				// uncomment to enable onComplete handler
				'complete' => 'myComplete',
				'update'=> '#response'),
			array('id'=> 'nicestuff','class'=>'ui-state-default ui-corner-all')
		);  
		?>
		
<?php echo EHtml::endForm(); ?>
<script type="text/javascript">
/*<![CDATA[*/
	function myBeforeSend(){
		showloading('<p class="loadingbar">数据读取中 请稍候...</p>');
	}
	function myComplete(){
		showloading('<p class="loadingbar">操作完成...</p>');
		return false;
	}
/*]]>*/
</script>
