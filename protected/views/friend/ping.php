<?php
    include('_top.php');
?>
<div class="grid_15 suffix_1">
	<div class="FList mt10"><!-- 好友屏蔽 begin  -->
		<h2 class="fB lh30 btmline">屏蔽以下用户的动态</h2>
		<ul style="margin-top:10px;">
			<li class="li">
				<div class="left alR" style="width: 20%;">用户名：</div>
				<?php echo CHtml::beginForm('','POST',array('class'=>form_validator)); ?>
					<div class="left" style="width:300px;;">
						<div><?php if(!Yii::app()->user->isGuest) $this->widget('WFriendSelect'); ?></div>
						<div><input type="submit" class="btn_b" style="margin-top:5px;" value="添 加" /></div>
					</div>
				<?php echo CHtml::endForm(); ?> 
				<div class="c"></div>
			</li>
		</ul>
		<br /><br />
		<h2 class="fB lh30 btmline">已屏蔽动态的用户</h2>
		<ul>
			<volist name="pings" id="ping">
				<li class="btmlineD li pb10" id="ping_{$ping.fuid}">
					<div class="left" style="width:77px;;"><span class="headpic50"><img src="{$ping.fuid|getUserFace}" /></span></div>
					<div class="left" style="width:450px; margin-right:40px;">
						<p class="lh20" style="margin-bottom:5px;"><strong><a href="#">{$ping.fuid|getUserName}</a></strong></p>
						<p class="cGray2 lh20">心情：{$ping.fuid|getUserMini}</p>
					</div>
					<div class="left alR" style="width:65px;">
						<p class="lh30"><a href="javascript:removePing({$ping.fuid})">解除屏蔽</a></p>
					</div>
					<div class="c"></div>
				</li>
			</volist>
		</ul>
		<div class="page">{$page}</div>
	</div><!-- 好友屏蔽 end  -->
</div>
