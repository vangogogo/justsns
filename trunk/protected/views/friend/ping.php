	<div class="mt10"><!-- 好友屏蔽 begin  -->

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
        <div class="clear"></div>
		
        <?php if(!empty($black_friends)):?>
        <h2>已屏蔽动态的用户</h2>
		<ul>
		    <?php foreach($black_friends as $friend){?>
                <?php $this->renderPartial('_friend_list',array('friend'=>$friend,'uid'=>$uid,'is_me'=>$is_me));?>
		    <?php }?>
		</ul>
        <?php endif;?>
	    <div class="baikeUserPage">
		    <?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	    </div>
	</div><!-- 好友屏蔽 end  -->

