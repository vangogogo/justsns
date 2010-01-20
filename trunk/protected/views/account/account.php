<?php
    include('_top.php');
?>
<?php
		$CS=Yii::app()->jformvalidate;
		echo $CS->beginForm(); 
		$CS->setScenario("update");
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
<div style="padding-top: 30px;" class="data">
	<div style="padding: 10px 0px;" class="lh18 alC border cGray2">
		为了更好地保护你的账户安全，需要验证你拥有这个Email地址。
		<br/>
		我们会向你的新Email地址发送一封电子邮件，请单击电子邮件正文中的链接或按照说明操作。
	</div>
	<div>
        <ul>
            <li><div class="left alR" style="width: 15%;">旧Email：</div><div class="left" style="width: 70%;"><?php echo Yii::app()->user->email;?></div>
           
            </li>
            <li>
                <div class="left alR" style="width: 15%;">新的Email：</div><div class="left" style="width: 70%;">
                    <input name="email" type="text" class="TextH20" id="textfield14" style="width:200px;"  onBlur="this.className='TextH20'" onFocus="this.className='Text2'" require="true" datatype="email|ajax" url="__URL__/checkEmail" msg="重要！请填有效邮箱地址，以收邮件完成注册|邮箱已被占用!"/>
                </div>
            </li>
            <li>
                <div class="left alR" style="width: 15%;">验证码：</div><div class="left" style="width: 70%;">
                    <input name="verify" class="TextH20" id="textfield14" style="width:60px;" onBlur="this.className='TextH20'" onFocus="this.className='Text2'" require="true" datatype="require|ajax" url="__URL__/checkVerify" msg="验证码不能为空|验证码输入有误，请重输！"/>
                    <div class="left">
                        <img src="__URL__/verify" id="verifyimg"/><br /><a href="###" onclick="changeverify()">看不清 换一张</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="left alR" style="width: 15%;">&nbsp;</div>
                <div class="left" style="width: 70%;">
                    <input name="button" type="submit" class="btn_b" id="button" value="确认修改" />
                </div>
            </li>
        </ul>
	</div>
</div>
<?php echo $CS->endForm(); ?>
