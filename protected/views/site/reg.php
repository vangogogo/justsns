<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reg.css" />
	<div class="RegBox">
		<p class="alR cGray2">已经注册的用户请 <?php echo CHtml::link('登录',array('/site/login'))?></p>
		<h1 class="cBlue">注册：完善你的个人信息，加入{$site_opts.site_name}</h1>
		<p class="cGray">{$site_opts.site_name}是帮助你与朋友、同事、同学、家人保持更紧密联系的真实社交平台，在这里你可以及时了解他们的最新动态；结识更多的新朋友</p>
<style>
	.error_info {display:none;}
	.cc .invalid {
		background:#FBE6F2 none repeat scroll 0 0;
		border:1px solid #D893A1;
		color:#996633;
	}
</style>
<?php
		$CS=Yii::app()->jformvalidate;
		echo $CS->beginForm(); 
		$CS->setScenario("reg");
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
			'keyup' 				=> true,
			'focusout' 				=> true,
			
			'highlight' 			=> '
				function(element,errorClass){

			       		$(element).addClass("invalid");
			       		$(element).parents("li").find("div.error_info").show().prev(".success").hide();					
			}',
			'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);}'
		));
		
?>

<?php echo CHtml::errorSummary($form);?>
			<input type="hidden" name="code" value="{$code}">
		  
			<ul>
				<li>
					<div class="cl">您的Email：<em>*</em></div>
					<div class="cc">
						<?php echo $CS->activeTextField($form,'email',array('class'=>'t_input')); ?>
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
					<div class="cl">设置登录密码：<em>*</em></div>
					<div class="cc">
						<?php echo $CS->activePasswordField($form,'password',array('class'=>'t_input')); ?>
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
					<div class="cl">再输入一遍密码：<em>*</em></div>
					<div class="cc">
						<?php echo $CS->activePasswordField($form,'repassword',array('class'=>'t_input')); ?>
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
			</ul>
			<ul>
				<li>
					<div class="cl">你的姓名：<em>*</em></div>
					<div class="cc">
						<?php echo $CS->activeTextField($form,'username',array('class'=>'t_input')); ?>
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
						<select name="birthday_year">
							<?php for($i=1930;$i<=2009;$i++){?>
								<option value="<?php echo $i;?>" <?php if($i == 1980) echo 'selected'; ?> ><?php echo $i;?></option>
							<?php }?>
						</select>年 
						<select name="birthday_month" id="birthday_month">
							<?php for($i=1;$i<=12;$i++){ ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						</select>月 
						<select name="birthday_day" id="birthday_day">
							<?php for($i=1;$i<=31;$i++){ ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						</select>日												
					</div>
					<div class="c"></div>
					
				</li>
				<li>
					 <div class="cl">居住城市：</div>
					<div class="cc">
					<input type="hidden" name="ts_areaval" id="ts_areaval"/>
						<?php echo $CS->activeTextField($form,'area',array('class'=>'t_input','style'=>"width:165px;float:left;")); ?>

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
				<li><div class="cl">隐私设置：</div>
					<div class="cc">
						<select name="baseinfoprivacy" style="width:250px;">
							<option value="0">任何人能看见我的资料和内容</option>
							<option value="1" selected="selected">仅好友能看见我的资料和内容</option>
							<option value="2">隐藏我的资料和内容</option>
						</select>
					</div>
					<div class="c"></div>
				 </li>
			</ul>
			<ul>
				<?php if($reg_verify_allow){ ?>

				<li>
					<div class="cl">验证码：<em>*</em></div>
					<div class="cc">
						<?php $this->widget('CCaptcha'); ?><br/>
						<?php echo $CS->activeTextField($form,'verifyCode',array('class'=>'t_input')); ?>
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
				<?php } ?>

				<li><div class="cl"><em>&nbsp;</em></div><div class="cc"><a href="Javascript:service_dialog();">{$site_opts.site_name}网服务条款</a> </div><div class="cr"></div>
				<div class="c"></div>
				</li>
				<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
					<?php echo CHtml::submitButton('同意条款 立即注册',array('class'=>'btn_reg hand')); ?>
					</div><div class="cr"></div>
					<div class="c"></div>
				</li>
			</ul>
<?php echo $CS->endForm(); ?>
	</div>
