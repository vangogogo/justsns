<div class="grid_15 suffix_1">
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
<div class="data jsvform" style="padding-top:30px;">
<?php echo EHtml::errorSummary($form);?>
	<ul>
		<li>
			<div class="cl">群介绍：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeTextarea($form,'intro',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue"><p class="error_content"></p><span class="clue_btm"></span></div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</li>
		<li>
			<div class="cl">群分类：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeDropDownList($form,'cid0',$category_list,array('class'=>'t_input','empty'=>'请选择')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue"><p class="error_content"></p><span class="clue_btm"></span></div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</li>
		<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
			<?php echo CHtml::submitButton('确认',array('class'=>'btn_b')); ?>
			</div><div class="cr"></div>
			<div class="c"></div>
		</li>
	</ul>
</div>
<?php echo EHtml::endForm();?>
</div>
<div class="grid_8">

    
    <p class="m">真的要建一个新的小组吗？</p>
    <div class="indent"><span class="pl">
    如果想就某一类话题（例如自助游、香港电影、python等）跟别人交流，可以创建一个小组。小组是对同一个话题感兴趣的人的聚集地。<br><br>
    每个人最多可以管理和申请创建15个小组，最多可以参加250个小组。<br><br>
    豆瓣目前有数万个小组，你感兴趣的话题很有可能正在被某个小组热烈讨论，建议你先在下面找找。</span></div>
    <br>
    <h2>豆瓣小组搜索 &nbsp; ·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;
        </h2><div class="infobox">
    <div class="ex1"><span></span></div>
    <div class="bd">
    <form id="group_search" name="group_search" action="/search" method="get">
    <div class="tc"><input name="q" class="j a_search_text input_search greyinput" type="text" size="20" maxlength="36" value=""></div>
    <div class="tc"><input class="butt" name="group_submit" type="submit" value="搜索小组"> &nbsp; &nbsp;
    
        <input name="topic_submit" class="butt" type="submit" value="搜索发言">
        
    </div></form>
    </div>
     <div class="ex2"><span></span></div>
     </div><br><br><p class="pl2">&gt; <a href="/group/category/1/">浏览小组分类</a></p>

</div>