<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/space.css');?>
<include file="../Public/home_right" />

<div class="cc">
	<div class="user_info"><!-- 用户资料 begin  -->
		<div class="user_img">
			<div class="img" id="host_face"><img src="<?php echo user::model()->getUserFace($uid,'middle');?>" /></div>
			<div id="my_face" style="display:none"><img src="<?php echo user::model()->getUserFace($mid,'small');?>" /></div>
			<div class="menu bg01">
				<?php
					if($uid == $mid){ 
						echo CHtml::link('更改头像',array('/info/face'),array('title'=>'更改头像'));
						echo CHtml::link('隐私设置',array('/privacy'),array('title'=>'隐私设置'));
						echo CHtml::link('修改账号',array('/account'),array('title'=>'修改账号'));
						echo CHtml::link('修改资料',array('/info'),array('title'=>'修改资料'));
					}elseif($mid){ 
						echo CHtml::link('详细资料',array('/space/detail','uid'=>$uid),array('title'=>'详细资料'));
						echo CHtml::link('给{$show_sex}留言',array('/space/detail','uid'=>$uid),array('title'=>'给{$show_sex}留言'));
					
						if($is_friend){
							echo CHtml::link('发短消息',array('/space/detail','uid'=>$uid),array('title'=>'发短消息'));
						}else{
							echo CHtml::link('加为好友',array('/friend/add','uid'=>$uid),array('title'=>'加为好友'));
						}	
					}
				?>
				<div class="c"></div>
			</div>
		</div>
		<div class="Linfo">
			<div class="info">
				<h2 id="host_name">{$uid|getUserName} {$uid|getUserGroupIcon}</h2>
				<h2 id="my_name" style="display:none">{$my_name}</h2>
				<?php 
						if($mid != $uid){
						$href = "__ROOT__/apps/mini/index.php?s=/Index/friends/uid/".$the_mini['uid'];
						}else{
						$href = "__ROOT__/apps/mini/index.php?s=/Index/my";
						}
				 ?>
				<?php if($space_privacy){ ?><p><span>{$the_mini.content}</span><span><em>{$the_mini.cTime|friendlyDate}</em></span><span><a href="{$href}">更多</a></span></p><?php } ?>

				<?php if($space_privacy){ ?>	 <!--隐私控制-->
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
	<!--用户应用-->
	<div class="system_info">
		<?php if(!empty($user_apps)) foreach($user_appas as $vo){?>
		<volist name="user_apps" id="vo">
			<?php $app_num = isset( $apps_num[$vo['enname']] )?$apps_num[$vo['enname']]:0;
$vo['name'] = '相册' == $vo['name'] ? '相片':$vo['name'];
				 if(empty($vo['uid_url'])) continue;
			 ?>
			<span><img src="{$vo.icon}" /><a href="{$vo.uid_url}{$uid}">{$app_num}个{$vo.name}</a></span>
		<?php }?>
	</div>
	<!--用户应用end-->

	<?php if(!$space_privacy){ ?>
	<br/>
	<?php if($is_hide){ ?>
	<div style="display: block;" class="ta_wqfw" id="limitdiv">{$uid|getUserName}的个人主页目前处于隐藏状态。</div>
	<?php }else{ ?>
	<div style="display: block;" class="ta_wqfw" id="limitdiv">由于对方的隐私设置，你没有权限查看。</div>
	<?php } ?>


	<?php } ?>


	<?php if($space_privacy){ ?>	 <!--隐私控制-->

	<div class="Feed"><!-- 个人动态 begin  -->
		<div class="tab-menu"><!-- 切换标签 begin  -->
			<div class="right lh35"><a href='__APP__/Home/allFeed/type/all/uid/{$uid}'>查看全部动态</a></div>
			<ul>
				<li><a class="on feed_item" ><span>{$show_sex}的动态</span></a></li>
			</ul>
		</div><!-- 切换标签 end  -->
		<div class="FList">
			<include file="Home:feed" />
		</div>
		<div class="alR lh35"><a href='__APP__/Home/allFeed/type/all/uid/{$uid}'>查看全部动态</a></div>
	</div><!-- 个人动态 end  -->


	<?php if($wall_privacy){ ?>
	<div class="Guestbook" id="wall"><!-- 留言板 begin  -->
		<div class="tit"><span class="pl5">留言板</span></div>
		<div class="GB_box">
			<textarea name="textarea2" cols="" id="wall_con"></textarea>
			<input type="button" class="btn_b" value="留 言" id="sub_button" onclick="wall()"/>
			(每条最多2000字)     
			<label><input type="checkbox" name="privacy" id="wall_privacy" value="1"/>悄悄话</label>
			<input type="hidden" name="uid" id="space_uid" value="{$uid}">
			<input type="hidden" id="my_name2" value="{$my_name}">
			<span style="display:none" id="my_face2"><img src="{$mid|getUserFace='middle'}" /></span>
		</div>
	</div>
	<div class="GBList" id="list_wall">

		<volist name="my_walls['data']" id="wall">
			<div class="Gli" id="wall_item_{$wall.id}">
				<div class="user_img"><span class="headpic50"><a href='__TS__/space/{$wall.fromUserId}' class="tips" rel="__TS__/Index/userInfo/uid/{$wall.fromUserId}"><img src="{$wall.fromUserId|getUserFace}" /></a></span></div>
				<div class="LC">
					<div class="MC">
						<h4 class="tit_Critique lh25 mb5 pl5"><span class="right"><a href="javascript:wall_reply_dis({$wall.id})">回复</a>
								<?php if($mid == $uid || $mid == $wall["fromUserId"]){ ?>&nbsp;<a href="javascript:wall_del({$wall.id})">删除</a>
								<?php } ?></span><a href="__TS__/space/{$wall.fromUserId}"><strong>{$wall.fromUserName}</strong></a><span class="cGray2">{$wall.cTime|friendlyDate="full"}</span><span><?php if($wall["privacy"] == 1){ ?><font color="red">【悄悄话】</font><?php } ?></span></h4>
						<p class="WB">
							{$wall.content|textarea_output}
						</p>
						<a id="d-{$vo.id}"href='###' onclick="deleteMini('{$vo.id }')" class="del" title="删除" style="display:none;">删除</a>		</div>
					<div class="RC">
						<span id="wall_reply_list_{$wall.id}">
							<sublist name="wall['replys']" id="reply">
								<div class="RLI">
									<div class="user_img"><span class="pic38"><a href="__APP__/space/{$reply.fromUserId}" class="tips" rel="__TS__/Index/userInfo/uid/{$reply.fromUserId}" ><img src="{$reply.fromUserId|getUserFace}" /></a></span></div>
									<div class="RLC">
										<h4 class="tit_Critique lh20 mb5 pl5"> <a href="__APP__/space/{$reply.fromUserId}"><strong>{$reply.fromUserName}</strong></a><span class="cGray2">{$reply.cTime|friendlyDate="full"}</span></h4>
										<p>{$reply.content|textarea_output}</p>
									</div>
									<div class="c"></div>
								</div>
							</sublist>
						</span>



						<div class="RLI bg01" style="display:none" id="wall_reply_{$wall.id}">
							<div class="user_img"><span class="pic38"><img src="{$mid|getUserFace}" /></span></div>
							<div class="RLC">
								<div class="input_box">
									<textarea name="textarea" cols="" style="height:50px; line-height:18px; width:99%" id="wall_reply_con_{$wall.id}"></textarea>
									<?php if($wall["privacy"] == 1){ ?>
									<input type="checkbox" name="privacy" id="wall_privacy_{$wall.id}" value="1" checked="true" disabled="true"/>悄悄话
									<?php } ?>
									<input type="button" id="reply_button" class="btn_b mt5" value="回 复" onclick="wall_reply({$wall.id})"/><input type="button" class="btn_w mt5" value="取 消" onclick="wall_reply_cancel({$wall.id})"/>
								</div>
							</div>
							<div class="c"></div>
						</div>

					</div>
				</div>
				<div class="c"></div>
			</div>
		</volist>
		<?php if($my_walls['count']>=10){ ?><div class="alR"><a href="__URL__/guestbook/uid/{$uid}">查看所有留言</a></div><?php } ?>
	</div>
	<!-- 留言板 end  -->
	<?php } ?>


	<?php } ?> <!--隐私控制end-->

</div>


<div class="c"></div>