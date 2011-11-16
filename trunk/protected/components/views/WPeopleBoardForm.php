
<style>
.w_people_board textarea.txt{width:290px;height:120px; }
</style>
<style>
.seMentorBoard{ padding:5px 50px; background:#ECF9FB}
.seMentorBoard:hover{ background:#D0F0F4;}
.seMentorBoard .aeBody .aeBody-title{ font-size:20px; color:#5494B0; padding:15px 0 5px 40px; background:url(/static/themes/default/images/mentor/mentor_ask.png) no-repeat top left; line-height:1em; font-weight:normal;}
.seMentorBoard .aeBody .aeBody-con{*zoom:1; }
.seMentorBoard .aeBody .aeBody-con textarea{padding:5px; width:auto; border:4px solid #7AADC3; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px; height:100px; width:98%;}

.seMentorBoard .aeBody .aeBody-handle{ margin-top:5px; font-size:14px;}
.seMentorBoard .aeBody .aeBody-handle .btn span{ font-size:16px; padding-left:20px; background:url(/static/themes/default/images/mentor/mentor_ask_pub.png) no-repeat center left; letter-spacing:5px; }
.seMentorBoard .aeBody .aeBody-handle .aeBody-handle-check{ margin-right:5px;}
.seMentorBoard .aeBody .aeBody-handle .aeBody-handle-tip{ color:#999;}

</style>
<!-- 留言板 -->
<div id="<?php echo $htmlOptions['id'];?>" title="留言板" class="w_people_board">
	<form action="<?php echo $action;?>/" method="post">
		<?php if($htmlOptions['showSubmit']): ?>
			<textarea style="width:96%" name="board_content" class="t_area t_input _deftxt"  data-default="点击输入留言内容"></textarea>
		<?php else:?>
			<textarea style="widht:290px" name="board_content" class="t_area t_input"></textarea>
		<?php endif; ?>
		<input type="hidden" value="<?php echo $refer?>" name="refer">
		<input type="hidden" value="<?php echo $object_id;?>" name="object_id">
		<input type="hidden" value="<?php echo $object_type;?>" name="object_type">
		<input type="hidden" value="<?php echo $formhash;?>" name="formhash">

		<input type="submit" value="发 布" class="w_people_board_publish btn <?php _cklogin();?>" style="<?php if($htmlOptions['showSubmit']) echo ''; else echo 'display:none'; ?>" />
		<?php if($object_type == 'mentor'):?>
			<label for="<?php echo $htmlOptions['id'];?>_board_pm" ><input type="checkbox" class="aeBody-handle-check"  value="<?php echo $refer?>" name="board_pm" id="<?php echo $htmlOptions['id'];?>_board_pm"><span class="autologin" title="该消息将发送到导师的私人信箱">&nbsp;发送私信</span></label>
		<?php endif;?>
	</form>
</div>
<!-- 留言板 -->
