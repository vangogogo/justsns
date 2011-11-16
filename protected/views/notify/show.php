    <?php
	    include('_top.php');
    ?>
	<table width="100%">
		<tr>
			<td width="75" valign="top"> 
                <?php $this->widget('WUserFace', array('uid'=>$user->id)); ?>
			</td>
			<td valign="top">
				<?php if($msg->toUserId == Yii::app()->user->id):?>
				<span class="pl2">来自: <?php echo User::model()->getUserName($msg->fromUserId);?></a></span>
				<?php endif;?>

				<?php if($msg->fromUserId == Yii::app()->user->id):?>
				<span class="pl2">发往: <?php echo User::model()->getUserName($msg->toUserId);?></a></span>
				<?php endif;?>
				<br>
				<span class="pl2">时间: <?php echo date('Y-m-d H:s',strtotime($msg->ctime))?></span>
				<br>
				<br>
				<div class="ul">
					<span class="pl2">话题: </span>
					<span class="m"><?php echo $msg->subject;?></span>
				</div>
				<br>
				<?php echo $msg->content;?>
				<br/>
				<div class="ul">
					<br>
				</div>
				<p>
					<?php if($msg->fromUserId != Yii::app()->user->id):?>
                        <?php echo CHtml::link('回复',array('/notify/write','uid'=>$uid,'replyMsgId'=>$msg->primaryKey),array('title'=>'回复','class'=>'btn'));?>
					<?php endif;?>
                    <?php echo CHtml::link('删除',array('doDelMsg','msg_id'=>$msg->id),array('class'=>'btn a_confirm_link','title'=>'确认删除短信息?'))?>
				</p>
			</td>
		</tr>
	</table>
