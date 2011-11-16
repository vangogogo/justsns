<div class="sidebar">
	<div class="user_info"><!-- 用户资料 begin  -->
		<div class="user_img">
			<div class="img" id="host_face">
                <?php $this->widget('WUserFace', array('uid'=>$uid,'size'=>'big')); ?>
            </div>
			<div id="my_face" style="display:none"><img src="<?php echo $owner->getUserFace($mid,'small');?>" /></div>
			<div class="menu bg01">
				<?php
					if($uid == $mid){
						echo CHtml::link('更改头像',array('/info/face'),array('title'=>'更改头像'));
						echo CHtml::link('隐私设置',array('/privacy'),array('title'=>'隐私设置'));
						echo CHtml::link('修改账号',array('/account'),array('title'=>'修改账号'));
						echo CHtml::link('修改资料',array('/info'),array('title'=>'修改资料'));
					}elseif($mid){
						#echo CHtml::link('详细资料',array('/space/detail','uid'=>$uid),array('title'=>'详细资料'));
						echo CHtml::link('给TA留言',array('/notify/write','uid'=>$uid),array('title'=>'给TA留言'));

						if(!empty($is_friend)){
							echo CHtml::link('发短消息',array('/notify/write','uid'=>$uid),array('title'=>'发短消息'));
						}else{
							echo CHtml::link('加为好友',array('/friend/add','uid'=>$uid),array('title'=>'加为好友','class'=>'thickbox'));
						}
					}
				?>
				<div class="c"></div>
			</div>
		</div>
		<div class="Linfo">
			<div class="info">
				<h2 id="host_name"><?php echo $owner->getUserName($uid).' ';echo User::model()->getUserGroupIcon();?></h2>
				<h2 id="my_name" style="display:none"><?php echo $owner->getUserName()?></h2>
				<?php if(!empty($space_privacy) OR 1){ ?>
					<p>
						<span>
							<?php echo $owner->getUserMini();?></span><span></span><span>
							<?php echo CHtml::link('更多',array('/mini/index','uid'=>$uid));?>
						</span>
					</p>
				<?php } ?>

				<?php if(!empty($space_privacy)){ ?>	 <!--隐私控制-->
				<ul>
					<?php if(!empty($rank)){ ?><li><span class="l cGray2">等级：</span><span class="r cBlue" style="margin-top:6px;"><img src="<?php echo THEME_URL; ?>/images/group/{$rank['icon']}" title="{$rank['name']}" alt="{$rank['name']}"/></span></li><?php } ?>
					<volist name="credit" id="vo" k="key">
						<li><span class="l cGray2">{$key}：</span><span class="r cBlue">{$vo}</span></li>
					</volist>
				</ul>
				<ul>
					<?php foreach($userInfo as $k=>$v){ ?>
					<li><span class="l cGray2">{$k}：</span><span class="r cBlue">{$v}</span></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
		</div>
	</div><!-- 用户资料 end  -->


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
    <?php if(!empty($may)){ ?>
	<div class="UserList">
		<h2><span class="right"></span>你可能认识的人</h2>
		<div class="media-grid">
			
			<ul>
				<?php foreach($may_users as $user){?>
					<li>
						<span><a href="__APP__/space/{$user.id}" class="tips" rel="__TS__/Index/userInfo/uid/{$user.id}"><img src="{$user.id|getUserFace}" /></a></span>
						<div class="name"><a href="__APP__/space/{$user.id}">{$user.id|isOnlineIcon}{$user.name}</a></div>
					</li>
				<?php }?>
			</ul>

		</div>
		<div class="btm"></div>
	</div>
	<?php }?>
	
	<div class="UserList">
		<h2><?php if(!isset($space_privacy) || $space_privacy){ ?><span class="right">
		<?php echo CHtml::link('>>更多',array('friend/index','uid'=>$uid),array('class'=>'cGray2'));?>

		</span><?php } ?><?php if($is_me){echo '我';}else echo $owner->getUserName()?>的好友</h2>
		<div class="media-grid">
			<?php if(!empty($friend_list)){ ?>
			<ul>
				<?php foreach($friend_list as $user){?>
					<li>
                        <?php $this->Widget('WUserFace',array('uid'=>$user['id']));?>
						<?php if(!isset($space_privacy) || $space_privacy){ ?>
							<div class="name"><?php echo CHtml::link($user['username'],array('/space/','uid'=>$user['id']));?></div>
						<?php }else{ ?>
							<div class="name">{$user.id|isOnlineIcon}{$user.name}</div>
						<?php } ?>
					</li>
				<?php }?>
			</ul>
			<?php }?>
		</div>
		<div class="btm"></div>
	</div>
</div><!-- cr end  -->
