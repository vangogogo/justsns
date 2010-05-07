<?php
 include('_top.php');
?>

<?php
	echo EHtml::beginForm(); 
	EHtml::setOptions(array(
	
		//'errorLabelContainer' 	=> 'div.container ul',
		//'errorContainer'		=> 'div.container',
		'errorElement'			=> 'div',
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
<?php echo CHtml::errorSummary($form);?>
	<ul>
		<li class="btmline mb10 cGray2"><div style="width: 15%;" class="left alR">&nbsp;</div><div style="width: 50%;" class="left">&nbsp;</div><div style="width: 20%;" class="left">谁可以看见</div><div style="width: 15%;" class="left">在首页显示</div></li>
		<li>
			<div class="cl">用户名：<em>*</em></div>
			<div class="cc">
				<?php echo EHtml::activeTextField($form,'username',array('class'=>'t_input')); ?>
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
			<div class="cl">性别：<em>*</em></div>
			<div class="cc">
				<?php echo CHtml::activeRadioButtonList($form,'sex',array(1=>'男',0=>'女'),array('separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
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
			<div class="cl">出生日期：</div>
			<div class="cc">
				<?php
					for($i=1930;$i<=2009;$i++){
						$years[$i] = $i;
					}
					for($i=1;$i<=12;$i++){
						$months[$i] = $i;
					}
					for($i=1;$i<=31;$i++){
						$days[$i] = $i;
					}										
				?>
				<?php echo EHtml::activeDropDownList($form,'birthyear',$years,array('empty'=>'')); ?>年 
				<?php echo EHtml::activeDropDownList($form,'birthmonth',$months,array('empty'=>'')); ?>月 
				<?php echo EHtml::activeDropDownList($form,'birthday',$days,array('empty'=>'')); ?>日											
			</div>
			<div class="c"></div>
		</li>
		<li>
			<div class="cl">居住城市：</div>
			<div class="cc">
			<input type="hidden" name="ts_areaval" id="ts_areaval"/>
				<?php echo EHtml::activeTextField($form,'area',array('class'=>'t_input','style'=>"width:165px;float:left;")); ?>

				<input alt="<?php echo Yii::app()->createUrl('/site/getArea',array('pid'=>'0'));?>" title="选择地区" type="button" class="btn_b thickbox" value="选择地区" level='2' selectArea="true" style="float:left; margin-left:5px;" areatype="areaval" >
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
			<div class="cl">血型：</div>
			<div class="cc">
				<?php echo EHtml::activeDropDownList($form,'blood_type',$form->getBloodTypes(),array('empty'=>'')); ?>									
			</div>
			<div class="c"></div>
		</li>

		<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
			<?php echo CHtml::submitButton('确认修改',array('class'=>'btn_b')); ?>
			</div><div class="cr"></div>
			<div class="c"></div>
		</li>
	</ul>
</div><!-- 修改密码 end  -->
<?php echo EHtml::endForm(); ?>
