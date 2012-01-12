<li class="info row" id="fri_<?php echo $uid?>" >
	<div class="span2">
        <?php $this->widget('WUserFace',array('uid'=>$uid,'user'=>$user));?>
	</div>
	<div class="span5">
		<p class="lh20">
			<?php echo CHtml::link($user->getUserName(),array('/space/index','uid'=>$uid),array('id'=>'fname_'.$uid));?>
		</p>



    <?php if(empty($is_find)):?>
	<div class="user-group-opt user-opt">
           <span class="left">分组：</span> 
        <?php $this->widget('WFriendBelongGroup',array('fuid'=>$uid,'relation'=>$friend));?>
    </div>

    <?php endif;?>

	</div>
	<div class="span2">
		<p class="lh20">
			<?php echo CHtml::link('发送短信',array('/notify/write','uid'=>$uid));?>
		</p>

		<p class="lh20">
			<?php if($is_me) echo CHtml::link('解除关系',array('/friend/DoDelFriend','uid'=>$uid),array('class'=>'a_confirm_link','data-title'=>'确认解除关系?'));?>
		</p>
		<?php if(!empty($user->sina_id)):?>
	    <p>
            <a href="http://www.weibo.com/<?php echo $user->sina_id?>" target="_blank">前往微薄</a>
		</p>
        <?php endif;?>
	</div>
</li>
