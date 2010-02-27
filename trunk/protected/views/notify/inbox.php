<?php
	include('_top.php');
?>

<div class="MessageBox">
	<div class="MList border" style="width:830px;"><!-- 好友日志 begin  -->
		<div class="MenuSub pl5">
			<label for="message_selector">选择:</label>
			<select id="message_selector2" name="message_selector2" onchange="select_change(this)" class="mt5">
				<option selected="selected" value="^_^">---</option>
				<option value="unAll">不选</option>
				<option value="read">已读</option>
				<option value="unread">未读</option>
				<option value="all">全部</option>
			</select>
			<a href="javascript:bj_unread();" class="cGray2 bj_unread bj_all">标记未读</a>
			<a href="javascript:bj_read();" class="cGray2 bj_read bj_all">标记已读</a>
			<a href="javascript:del_some();" class="cGray2 bj_all">删除</a>
		</div>
		<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
				<form method="post" action="" id="the_box">
	
					<?php foreach($msgs as $msg){?>
						<tr id="msg_<?php echo $msg->id;?>" class="<?php if($msg['is_read'] == 0) echo 'bg01';?>">
							<td width="24" align="cente r" class="btmline">
							<input type="checkbox" name="checkbox" id="checkbox" value="<?php echo $msg->id;?>" class='checkbox <?php if($msg["is_read"] == 0) { echo "unread"; }else{ echo "read"; } ?>' />								</td>
							<td width="24" align="cente r" class="btmline" id="bj_pic_<?php echo $msg->id;?>">
								<?php   if($msg["is_read"] == 0) {?>
									<img src="__PUBLIC__/images/ico_mail1.gif" alt="未读" width="14" height="10" />
								<?php  }else{ ?>
									<img src="__PUBLIC__/images/ico_mail3.gif" alt="已读" width="14" height="12" />
								<?php  }?>
							</td>
							<td width="70" class="btmline">
								<a href="__APP__/space/<?php echo $msg->fromUserId?>">
									<img src="<?php echo $msg->fromUserId?>" width="50" height="50" />
								</a>
							</td>
							<td width="184" class="btmline">
								<a href="__APP__/space/{$msg->fromUserId}">{$msg->fromUserId|getUserName}</a><br />
								<?php echo friendlyDate('Y-m-d H:i:s',$msg->ctime);?>
							</td>
							<td width="473" class="btmline">
	
								<?php if($msg["is_read"] == 0) {?>
								  <strong><a href="__URL__/msg/t/inbox/lid/{$msg['id']}/id/<?php if($msg['replyMsgId'] == 0){ echo $msg['id']; }else{ echo $msg['replyMsgId']; } ?> ">{$msg->subject}</a> <br />
									  {$msg->content}
								  <a href="#nogo"></a></strong></td>
								<?php  }else{ ?>
								  <a href="__URL__/msg/t/inbox/lid/{$msg['id']}/id/<?php if($msg['replyMsgId'] == 0){ echo $msg['id']; }else{ echo $msg['replyMsgId']; } ?> ">{$msg->subject}</a> <br />
									  {$msg->content}
								  <a href="#nogo"></a></td>
								<?php  }?>
								<!--未读的加粗显示-->
							<td width="60" class="btmline"><a href="javascript:del_msg(<?php echo $msg->id;?>)">删除</a></td>
						</tr>
					<?php }?>
				</form>
			</table>
		</div>
		<div class="baikeUserPage">
			<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
		</div>
		
	</div><!-- 好友日志 end  -->
</div>