<div class="LogList">
<?php if(!empty($list)) foreach($list as $vo){?>
	<ul>
		<li class="bg04">
			<div class="box">
				<div class="c1">
					<span class="headpic50">
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>"  class="tips">
							<img src="<?php echo User::model()->getUserFace($vo['uid'],'middle');?>" />
						</a>
					</span>
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>"  class="U"><?php  echo $vo->username;?></a>
				</div>
				<div class="left" style="width: 67%;">
					<h3 class="f14px"><?php echo CHtml::link($vo->subject,array('/vote/show','uid'=>$vo->uid,'id'=>$vo->id),array('class'=>'U'));?></h3>
					<p class="cGray2">投票发起时间：<?php echo friendlyDate('Y-m-d',$vo->ctime);?></p>
					<p class="cGray2">目前投票人数：<?php echo $vo->votercount;?></p>
					<p><span class="right">此投票由<?php echo CHtml::link($vo->username,array('/space/','uid'=>$vo->uid));?>发起。</span>
					<?php if( $vo['expiration'] <= time() ){?>
						<span class="cRed">已结束</span>
					<?php }?>
					</p>
				</div>
				<div class="left alR" style="width: 18%;"> <?php echo CHtml::link('评论('.$vo->replycount.')',array('/vote/show','uid'=>$vo->uid,'id'=>$vo->id,'#'=>'comment'),array('class'=>'cGray2 U'));?><br />
				<br />
				<?php echo CHtml::link('去看看',array('/vote/show','uid'=>$vo->uid,'id'=>$vo->id),array('class'=>'btna'));?>
			</div>
		</li>
	</ul>
<?php }?>
<div class="baikeUserPage">
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>
</div><!-- LogList end  -->