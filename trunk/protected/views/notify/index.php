<?php
	include('_top.php');
?>
<script>
	function agreeFri(fuid,nid){
		Win({message:'__APP__/Friend/isAdd/uid/'+fuid+'/nid/'+nid+'/t/agree',width:392,height:220,title:'加为好友',handler:function(){ymPrompt.close();},autoClose:false,iframe:true,allowRightMenu:true});
	}

	function ignoreFri(uid,nid){
		Confirm({message:'确认忽略这条好友请求?',handler:function(tp){
				if(tp=='ok'){
					$.post(APP+"/Friend/ignoreFriend",{nid:nid,uid:uid},function(txt){
						if(txt == 1){
							Alert("忽略成功!");
							setTimeout(function(){ parent.ymPrompt.close(); },1500);
							location.reload();
						}else{
							Alert("忽略失败!");
						}
					});
				}
				if(tp=='cancel'){
					ymPrompt.close();
				}
				if(tp=='close'){
					ymPrompt.close();
				}
			}});
	}

	function set_group(fuid,nid){
		Win({message:'__APP__/Friend/setGroup/fuid/'+fuid+'/nid/'+nid,width:392,height:220,title:'加为好友',handler:function(){ymPrompt.close();},autoClose:false,iframe:true,allowRightMenu:true});
	}

	//删除某条动态
	function del_notify(id) {
		$.post(URL+"/del_notify",{id:id},function(txt){
			if(txt == 1){
				$("#notify_"+id).hide("slow");
			 }else{
				Error("删除失败!");
			 }
		});
	}


</script>

<div class="BlogBox">
	<div class="sidebar pt10">
	<div class="FSort">
	<div class="tit">通知类别</div>
		<ul>
			<?php foreach($type_arr as $key => $name){?>
			<li <?php if($type == $key)  echo 'class="on"';?>>
				<?php echo CHtml::link($name,array('/notify/index','type'=>$key));?>
			</li>
			<?php }?>
		</ul>
		<div class="btm"></div>
		</div>
	</div>
	<?php if(!empty($notifys)){?>
	<div class="MList" style="width:640px;"><!-- 通知列表 begin  -->
		<ul>
			<?php foreach($notifys as $key => $notify){?>
			<li class="btmlineD" id="notify_<?php echo $notify->id;?>">
				<div class="left" style="width:10%">
					<span class="headpic50">
					<?php if($notify['authorid']!=0){?>
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$notify->authorid));?>"  class="tips">
							<img src="<?php echo $user->getUserFace($notify->authorid);?>" alt="<?php echo $notify->author?>" />
						</a>
					<?php }else{?>
						<img src="<?php echo $user->getUserFace($notify->authorid);?>" alt="<?php echo $notify->author?>" />
					<?php }?>
					</span>
				</div>
				<div class="left" style="width:90%">
					<h3><div class="right alR"><div class="left"><em><?php echo friendlyDate('Y-m-d H:i',$notify->ctime);?></em></div><div class="left"><a href="javascript:del_notify(<?php echo $notify->id;?>)" class="del">删除</a></div></div><strong><?php echo $notify->type;?></strong></h3>
				<div>
				<div class="right alR">
						<!-- TIP -->
						<?php 
						/*
							if($notify["new"]>=2 &&  $notify["deal"]){
							echo '<div class="tip">';
								$deal = explode("|",$notify["deal"]);
								echo  ($notify["new"] == 2)?$deal[0]:$deal[1];
							echo '</div>';
							}
						*/
						?>
						<!-- TIP END -->
					</div>
					<p><?php echo $notify->title;?></p>
					<p><?php echo $notify->body;?></p>
				</div>
					<!-- URL -->
					<div class="lh35" style="margin-top:10px;">
						<lt name="notify.new" value="2">
						<?php if($notify['type'] == "add_friend"){?>
						<a href="javascript:agreeFri(<?php echo $notify->url;?>,<?php echo $notify->id;?>);">同意</a> | <a href="javascript:ignoreFri(<?php echo $notify->url;?>,<?php echo $notify->id;?>);">忽略</a>
						<?php }elseif($notify['type'] == "agree_friend"){?>
						<a href="javascript:set_group(<?php echo $notify->authorid;?>,<?php echo $notify->id;?>)">设置好友分组</a>
						<?php }elseif($notify["url"]){?>
						<a href="{$notify.url}">去看看</a>
						<?php }?>
						</lt>
					</div>
					<!-- URL END -->
				</div>
				<div class="c"></div>
			</li>
			<?php }?>
		</ul>
		<div class="baikeUserPage">
			<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
		</div>
	</div><!-- 通知列表 end  -->
	<?php }?>
</div>





