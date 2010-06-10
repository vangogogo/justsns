<?php
	include('_top.php');
?>

<div class="BlogBox">
	<div class="MList" style="width:640px;"><!-- 写短消息 begin  -->
		<div class="mt10 f14px lh30 cGray2"><strong>发送私密对话</strong></div>
		<?php echo CHtml::beginForm(); ?>
			<ul>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;"><strong>发送给：</strong></div>
					<div class="left" style="width: 408px;">
						<?php if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?>
						<!--<input type="text" class="TextH20" style="width:70%" onBlur="this.className='TextH20'" onFocus="this.className='Text2'"/>-->
					</div>
				</li>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;"><strong>主题</strong>：</div>
					<div class="left" style="width: 90%;">
						<input type="text" class="TextH20" style="width:70%" onBlur="this.className='TextH20'" onFocus="this.className='Text2'" name="Msg[subject]" dataType="LimitB" min="1" max="30"  msg="标题内容必须在[1,30]个字节之内" />
					</div>
				</li>
				<li>
					<div class="left lh25 fB alR" style="width: 10%;">内容：</div>
					<div class="left" style="width: 90%;">
						<textarea cols="" rows="15" style="width:99%" class="Text" onBlur="this.className='Text'" onFocus="this.className='Text1'" name="Msg[content]" dataType="LimitB" min="1" max="1000" msg="内容必须在[1，1000]个字节之内" ></textarea>
					</div>
				</li>
				<li>
					<div class="left lh25 fB" style="width: 10%;">&nbsp;</div>
					<div class="left" style="width: 90%;">
						<input type="submit" class="btn_b" value="发 送"/>
						<input type="button" class="btn_w" onclick="history.back(-1);"value="取 消" />
					</div>
				</li>
			</ul>
		<?php echo CHtml::endForm(); ?> 
	</div>
	<!-- 发短消息 end  -->
</div>
