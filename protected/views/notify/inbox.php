    <?php
	    include('_top.php');
    ?>
    <?php if(!empty($msgs)):?>
	<div class="MessageBox">
		<div class="MList border"><!-- 好友日志 begin  -->


				<?php echo CHtml::beginForm(); ?>
				<table width="100%" border="0" cellspacing="0" cellpadding="3" class="olt">
					<?php foreach($msgs as $msg){
						if($msg->toUserId == Yii::app()->user->id)
						{
							$msg_user = $msg->fromUser;
						}
						else
						{
							$msg_user = $msg->toUser;
						}
						?>
						<tr id="msg_<?php echo $msg->id;?>" class="<?php if($msg['is_read'] == 0) echo 'bg01';?>">
							<td width="24" class="btmline">
							<input type="checkbox" name="checkbox" id="checkbox" value="<?php echo $msg->id;?>" class='checkbox <?php if($msg["is_read"] == 0) { echo "unread"; }else{ echo "read"; } ?>' />								</td>
							<td width="24"class="btmline" id="bj_pic_<?php echo $msg->id;?>">
								<?php if($msg["is_read"]):?>
									<img src="<?php echo PUBLIC_URL;?>images/ico_mail1.gif" alt="未读" width="14" height="10" />
								<?php else:?>
									<img src="<?php echo PUBLIC_URL;?>images/ico_mail3.gif" alt="已读" width="14" height="12" />
								<?php endif;?>
							</td>
							<td width="70" class="btmline">
								<?php echo $msg_user->getSpaceUrlWithFace();?>
							</td>
							<td width="184" class="btmline">
								<?php echo $msg_user->getSpaceUrlWithName();?>
								<br />
								<?php echo friendlyDate('Y-m-d H:i',$msg->ctime);?>
							</td>
							<td width="473" class="btmline">
								<?php if($msg["is_read"]){?>
									<?php echo CHtml::link($msg->subject,array('show','msg_id'=>$msg->id));?>
								<?php }else{?>
									<strong><?php echo CHtml::link($msg->subject,array('show','msg_id'=>$msg->id));?></strong>
								<?php }?>
								<br/>
								<?php #echo $msg->content;?>
								<a href="#nogo"></a></td>
							<td width="60" class="btmline">
								<?php echo CHtml::link('删除',array('doDelMsg','msg_id'=>$msg->id),array('class'=>'a_confirm_link','title'=>'确认删除短信息?'))?>
							</td>
						</tr>
					<?php }?>
				</table>
				<?php echo CHtml::endForm(); ?>

			<div class="MenuSub pl5">
				<label for="message_selector">选择:</label>
				<select id="message_selector2" name="message_selector2" onchange="select_change(this)" class="mt5">
					<option selected="selected" value="^_^">---</option>
					<option value="unAll">不选</option>
					<option value="read">已读</option>
					<option value="unread">未读</option>
					<option value="all">全部</option>
				</select>
				<a href="javascript:del_some();" class="cGray2 bj_all">删除</a>
			</div>
			<div class="baikeUserPage">
				<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
			</div>
		</div><!-- 好友日志 end  -->
	</div>
    <?php endif;?>
