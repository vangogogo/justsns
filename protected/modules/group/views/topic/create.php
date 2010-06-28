<?php
	echo EHtml::beginForm(); 
	EHtml::setOptions(array(
		//'errorLabelContainer' => 'div.container ul',
		//'errorContainer'		=> 'div.container',
		'errorElement'			=> 'div',
		//'wrapper' 			=> 'li',
		'errorClass' 			=> 'invalid',
		
		//错误提示
		'errorPlacement' 		=> 'function(error, element) {element.parents("li").find("div.error_info").show(); var error_label = element.parent("div").next("div").find(".clue p");error.appendTo(error_label);}',
		//正确显示
		'success'				=>'function(label) { label.parents("div.error_info").hide().prev(".success").show();}',
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
<div class="groupBox">
<?php echo EHtml::errorSummary($form);?>
	<div class="boxL" style="width: 100%;">
		<div class="box1">
		<h3>发表新话题</h3>
		
		<ul class="pt10">
			<li class="li">
				<div class="lh35 alR left" style="width: 5%"><strong>标题：</strong></div>
				<div class="left" style="width: 95%">
					<?php echo EHtml::activeTextField($form,'title',array('class'=>'t_input')); ?>
				</div>	
			</li>
			<li class="li pt10">
				<div class="left alR" style="width: 5%"><strong>内容：</strong></div>
				<div class="left" style="width: 95%">
					{:W("Edit",array('smileList'=>$smileList,'smilePath'=>$smilePath,'rows'=>20,'cols'=>20,'name'=>'content','id'=>'icontent'))}
				</div>
			</li>
			<li class="li">
				<div class="lh35 alR left" style="width: 5%"><strong>附件：</strong></div>
				<div class="left" style="width: 95%; padding-top: 5px;">
					{:W('UploadAttach',array( 'uid'=>$mid , 'type'=>'group_topic' ,'callback'=>'attach_upload_success') )}
				</div>
			</li>
			<li class="li">
				<div style="width: 5%" class="left">&nbsp;</div>
				<div class="left" style="width: 95%">
					<input type="hidden" name="addsubmit" value="do"> <input name="button" type="submit" class="btn_b mt5" id="button" value="发表话题" />
				</div>
			</li>
		</ul>
		
		</div>
	</div>
</div>
</div><!-- 修改密码 end  -->
<?php echo EHtml::endForm();?>