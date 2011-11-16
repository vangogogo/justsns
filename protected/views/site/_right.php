<div class="sidebar">

        <?php $this->Widget('WFriendFind');?>

	<?php if(!isset($space_privacy) || $space_privacy){ ?>

	<?php if($visitors){ ?>
			<div class="UserList">
				<div class="tit">
				  <?php if( MODULE_NAME == 'Home' || $uid == $mid ){ ?>
					<span class="right">
						<?php echo CHtml::link('>>更多',array('friend/track','uid'=>$uid),array('class'=>'cGray2'));?>
					</span>
					<?php } ?>
					最近来访<span>（{$visitor_num}）</span></div>
				<div class="ListBox">
					<ul>
						<?php foreach($visitors as $user){?>
							<li style="height:100px; overflow:hidden;">
								<span><a href="__APP__/space/{$user.visitId}" class="tips" rel="__TS__/Index/userInfo/uid/{$user.visitId}"><img src="{$user.visitId|getUserFace}" /></a></span>
								<div class="name"><a href="__APP__/space/{$user.visitId}">{$user.visitId|isOnlineIcon}{$user.name}</a></div>
								<?php if(MODULE_NAME != 'Space'){ ?><em>{$user.cTime|friendlyDate}</em><?php } ?>
							</li>
						<?php }?>
					</ul>
			  </div>
				<div class="btm"></div>
			</div>
	<?php } ?>


	<?php } ?>

	<div class="UserList">
		<h2><span class="right"></span>你可能认识的人</h2>
		<div class="ListBox">
			<?php if(!empty($may)){ ?>
			<ul>
				<?php foreach($may_users as $user){?>
					<li>
						<span><a href="__APP__/space/{$user.id}" class="tips" rel="__TS__/Index/userInfo/uid/{$user.id}"><img src="{$user.id|getUserFace}" /></a></span>
						<div class="name"><a href="__APP__/space/{$user.id}">{$user.id|isOnlineIcon}{$user.name}</a></div>
					</li>
				<?php }?>
			</ul>
			<?php }?>
		</div>
		<div class="btm"></div>
	</div>

	
	<div class="UserList">
		<h2><?php if(!isset($space_privacy) || $space_privacy){ ?><span class="right">
		<?php echo CHtml::link('>>更多',array('friend/index','uid'=>$uid),array('class'=>'cGray2'));?>

		</span><?php } ?><?php if($is_me){echo '我';}else echo $owner->getUserName()?>的好友</h2>
		<div class="ListBox">
			<?php if(!empty($friend_list)){ ?>
			<ul class="unstyled">
				<?php foreach($friend_list as $user){?>
					<li>
                        <?php $this->Widget('WUserFace',array('uid'=>$user['id']));?>
					</li>
				<?php }?>
			</ul>
			<?php }?>
		</div>
		<div class="btm"></div>
	</div>
</div><!-- cr end  -->
