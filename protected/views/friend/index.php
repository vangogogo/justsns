<?php
	include('_top.php');
?>
<div class="grid_15 suffix_1">
11
    <?php if(!empty($friends)):?>
	<ul style="padding: 0px;margin: 10px auto 0px auto;">
		<?php foreach($friends as $friend){?>
			<li class="btmlineD li pb10 pt5" id="fri_<?php echo $friend['id']?>" >
				<div class="left" style="width:70px;">
					<span class="headpic50">
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$friend['id']));?>"  class="tips">
						<img src="<?php echo $friend['face'];?>" />
					</a>
					</span>
				</div>
				<div class="left" style="width:450px; margin-right:50px;">
					<p class="lh20">
						<?php echo CHtml::link($friend['username'],array('/space/','uid'=>$friend['id']),array('id'=>'fname_'.$friend['id']));?>
					</p>

					<p class="cGray2 lh20">分组：
						<?php 
						echo Friend::model()->getGroupsName($uid,$friend['id']);
						if($is_me){
							echo CHtml::link('分组',array('/friend/group','fuid'=>$friend['id']),array('class'=>'thickbox','title'=>'修改好友分组'));
						}
						else echo CHtml::encode('分组');
						?>
					</p>
					<p class="cGray2 lh20"><span class="wn">心情：</span><?php echo $friend['mini'];?></p>
				</div>
				<div class="left" style="width:60px;">
					<p class="lh20">
						<?php echo CHtml::link('发送短信',array('/notify/write','uid'=>$friend['id']));?>
					</p>
					
					<p class="lh20">
						<?php if($is_me) echo CHtml::link('解除关系',array('/friend/DoDelFriend','uid'=>$friend['id']),array('class'=>'a_confirm_link','title'=>'确认解除关系?'));?>
					</p>
				</div>
				<div class="c"></div>
			</li>
		<?php }?>
	</ul>

	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
    <?php endif;?>

</div><!-- 我的好友 end  -->
<div class="grid_8">
	<?php if(!Yii::app()->user->isGuest) $this->widget('WFriendGroup'); ?>
</div>

