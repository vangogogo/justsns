<div class="grid_8">
	<div class="UserList">
		<?php echo CHtml::beginForm(array('friend/list'),'get',array('class'=>'form_validator','id'=>'list_fri'))?>
			<input type="hidden" name="type" value="info" id="sub_type">
			<div class="tit">搜索用户</div>
			<div class="ListBox">
			<div ><div style="float:left; width:170px; padding-left:10px;"><input name="name" class="TextH20" style="width:165px; margin-right:5px;" type="text"  onblur="this.className='TextH20'" onfocus="this.className='Text2'" /></div><div style="float:left;" ><input type="submit" class="btn_b hander" value="找 人" /></div>
			</div>
			</div>
			<div class="btm"></div>
		<?php echo Chtml::endForm();?>
	</div>
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
		<div class="tit"><span class="right"></span>你可能认识的人</div>
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
		<div class="tit"><?php if(!isset($space_privacy) || $space_privacy){ ?><span class="right">
		<?php echo CHtml::link('>>更多',array('friend/index','uid'=>$uid),array('class'=>'cGray2'));?>

		</span><?php } ?><?php if($is_me){echo '我';}else echo $owner->getUserName()?>的好友</div>
		<div class="ListBox">
			<?php if(!empty($friend_list)){ ?>
			<ul>
				<?php foreach($friend_list as $user){?>
					<li>
						<span>
						<?php if(!isset($space_privacy) || $space_privacy){ ?><a href="<?php echo $this->createUrl('/space/',array('uid'=>$user['id']));?>"  class="tips"><img src="<?php echo $user['face'];?>" /></a>
						<?php } ?>
						</span>
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
