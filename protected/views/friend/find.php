<?php $this->Widget('WFriendFind');?>
    <?php if(!empty($users)):?>
	<ul class="user-list">
		<?php foreach($users as $friend){?>
            <?php $this->renderPartial('_friend_list',array('friend'=>$friend,'uid'=>$uid,'is_me'=>$is_me));?>
		<?php }?>
	</ul>

	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
    <?php endif;?>
