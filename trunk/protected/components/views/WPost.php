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
	$(function() {

		//run the currently selected effect
		function runEffect(){
			//get effect type from 
			var selectedEffect = $('#effectTypes').val();
			
			//most effect types need no options passed by default
			var options = {};
			//check if it's scale or size - they need options explicitly set
			if(selectedEffect == 'scale'){  options = {percent: 100}; }
			else if(selectedEffect == 'size'){ options = { to: {width: 280,height: 185} }; }
			
			//run the effect
			$("#effect").show(selectedEffect,options,500,callback);
		};
		
		//callback function to bring a hidden box back
		function callback(){
			setTimeout(function(){
				$("#effect:visible").removeAttr('style').hide().fadeOut();
			}, 1000);
		};
		
		//set effect from select menu value
		$("#button").click(function() {
			runEffect();
			return false;
		});
		
		$("#effect").hide();
	});
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

<?php echo EHtml::submitButton('发送',array('id'=> 'send_reply','value'=>'发送','class'=>'btn_b mt5')); ?>

		<?php 
		echo EHtml::ajaxSubmitButton('Ajax Submit',Yii::app()->createUrl('group/topic/doAddPost'),
			array(
				'beforeSend' => 'myBeforeSend',
				// uncomment to enable onComplete handler
				'complete' => 'myComplete',
				'update'=> '#response'),
			array('id'=> 'nicestuff')
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
