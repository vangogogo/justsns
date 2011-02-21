<?php
	include('_top.php');
?>
<div class="grid-16-8 clearfix">
	<div class="grid_16">
		<table width="100%">
			<tr>
				<td width="75" valign="top">
					<?php echo $user->getSpaceUrlWithFace($user->id,1);?>
				</td>
				<td valign="top">
					<?php if($msg->toUserId == Yii::app()->user->id):?>
					<span class="pl2">来自: </span>
					<span class="pl2"><?php echo User::model()->getSpaceUrlWithName($msg->fromUserId);?></span>
					<?php endif;?>

					<?php if($msg->fromUserId == Yii::app()->user->id):?>
					<span class="pl2">发往: </span>
					<span class="pl2"><?php echo User::model()->getSpaceUrlWithName($msg->toUserId);?></span>
					<?php endif;?>
					<br>
					<span class="pl2">时间: <?php echo date('Y-m-d H:s',$msg->ctime)?></span>
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
						<input type="submit" value="回复" name="m_reply">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php endif;?>
						<input type="submit" value="删除" name="m_delete">
					</p>
				</td>
			</tr>
		</table>
	</div>
	<div class="grid_8">
		<p class="pl2">
			&gt; <a href="/notify/">回我的收件箱</a>
		</p>
		<p class="pl2">
			&gt; <?php echo CHtml::link('去'.$user->getUserName().'的主页',$user->getSpaceUrl());?>
		</p>
		<br>
		<br>
		<p class="pl2">
			&gt; <a href="#">将<?php echo $user->getUserName()?>列入我的黑名单</a>
		</p>
	</div>
	<div class="extra">
	</div>
</div>
