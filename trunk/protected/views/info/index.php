<?php
    include('_top.php');
?>
<?php
		$CS=Yii::app()->jformvalidate;
		echo $CS->beginForm(); 
		$CS->setScenario($form->scenario);
		$CS->setOptions(array(
		
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

</div><!-- 修改密码 end  -->
<?php echo $CS->endForm(); ?>
