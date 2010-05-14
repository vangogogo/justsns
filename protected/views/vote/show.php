<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/poll.css');?>
<div class="page_title"> <!-- page_title begin -->
	<div class="left" style="width:66px;;">
		<span class="headpic50">
			<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>"  class="tips">
				<img src="<?php echo user::model()->getUserFace($vo['uid'],'middle');?>" />
			</a>
		</span>
	</div>
	<div class="left">
		<h2><?php if( $vote['uid'] == $mid ){ ?>我<?php }else{ ?>{$vote['name']}<?php } ?>发起的投票</h2>
		<p><a href="__TS__/space/{$vote.uid}"><?php if( $vote['uid'] == $mid ){ ?>我<?php }else{ ?>{$vote['name']}<?php } ?>
				的个人空间</a> ┊ <a href="__URL__/<?php if( $vote['uid'] == $mid ){ ?>my<?php }else{ ?>personal/uid/{$vote.uid}<?php } ?>">
				<?php if( $vote['uid'] == $mid ){ ?>我<?php }else{ ?>{$vote['name']}<?php } ?>的投票</a></p>
	</div>
	<div class="c"></div>
</div><!-- page_title end -->
<div class="pollBox">
	<div class="cGray2 pt5 topline">
		<div class="right lh25"><?php if( $mid == $vote['uid'] ){ ?>
			<?php if ( $vote['expiration'] > time() ){ ?>
			<a href="javascript:getMessage()">增加候选项</a><br />
			<?php } ?>
			<a href="javascript:deleteVote({$vote.id})">删除投票</a><br />
			<a href="javascript:getMessage2()">修改结束时间</a><br />
			<?php }else{ ?>
			{:W('Report',array( 'type'=>'投票举报','appid'=>$APPINFO['APP_ID'],'url'=>'Index/pollDetail/id/'.$vote['id'],'title'=>$vote['title'],'recordId'=>$vote['id'] ))}<?php if(0 AND isAddApp('share')) {  ?><input type="button" value="分享" class="BtnShare" style="margin-left:10px;" onclick="ts_sharePop('{$vote.id}','__URL__')" id="BtnShare_{$vote.id}"/>
			<?php } } ?></div>
		<div>
			<span>发起时间：<?php echo friendlyDate('Y-m-d H:i:s',$vote['ctime']);?></span><br/>
			<span>已投票数：<?php echo $vote->votercount;?></span><br/>
			<span>截止时间：<?php echo friendlyDate('Y-m-d H:i:s',$vote['expiration']) ?></span>
		</div>
	</div>
	<div style="width:70%; margin:0 auto;">
		<h1 class="alC lh35 f14px"><span class="f14px fB cBlue"><?php echo $vote->subject;?></span><span class="cGray2" >(可选<span id="most_vote_num"><?php echo intval( $vote['maxchoice'])+1; ?></span>个)</span></h1>
		<p class="cGray2"><?php echo $vote['message'];?></p>
	</div>

	<div class="LogList" style="width:100%; ">

		<form method="post" action="">
			<ul style="width:580px;" class="left">
				<?php if(!empty($vote->option)){ foreach($vote->option as $key => $vo)	{?>

					<li>
						<div class="left alR" style="width: 245px;"><?php echo $vo->option?>:</div>
						<div class="left" style="width: 204px;">
							<div class="poll">
								<?php $kk = $k%10; ?>
								<div class="vbg v<?php echo $kk?$kk:( $kk+1 ); ?> vote-per-{$k-1}" id="bg<?php echo $kk?$kk:( $kk+1 ); ?>" style="width:0px;">
									<span></span>
								</div>
							</div>
						</div>
						<div class="left" style="width: 81px;">{$vo.num}({$vote_pers[$k-1]}%)</div>
						<div class="left" style="width: 30px;">
							<?php
								$des = "投票";
								if( $has_vote == true || $vote['expiration'] <= time() || ( '1' == $vote['novote'] && $mid != $vote['uid'] && false == $api->friend_areFriends( $mid,$vote['uid'] )  ) ){
								$css = "disabled";
								$des = "仅好友可投票";
								} ?>
							<?php if( $vote['maxchoice'] == 0){ ?>
							<input name="vote_opt" type="radio" value="{$vo.name}" id="{$vo.id}" {$css}/>
								   <?php }else{ ?>
							<input name="vote_opt" type="checkbox" value="{$vo.name}" id="{$vo.id}" {$css}/>
								   <?php } ?>
						</div>
						<div class="c"></div>
					</li>
				<?php }}?>
			</ul>
			<?php if( $vote['expiration'] <= time() ){ ?>
			<span class="cRed">已结束</span>
			<?php }elseif( $mid != $vote['uid'] && $vote['onlyfriend'] == 1 && false == $api->friend_areFriends( $mid,$vote['uid'] ) ){ ?>
			<span class="cRed">只允许好友投票</span>
			<?php }elseif( $has_vote ){ ?>
			<span class="cRed">您已经投过票</span>
			<?php }else{ ?>
			<div class="left"><input name="" type="button" style="cursor:pointer" onclick='post_vote( {$vote.type})' class="btn_b" value="<?php echo $des?>" {$css}/></div>
			<?php } ?>
		</form>
		<div class="clear"></div>
	</div><!-- LogList end  -->

	<?php

		if( "friend" == $vote_join ){
		$join = "好友";
		}else{
		$join = "大家";
		}

	 ?>

	<div class="circs" style="padding-bottom:20px;">
		<?php if( $empty_friend ){ ?>
		<?php echo $join ?>还没有投票
		<?php }else{ ?>
		<dl>
			<dt><?php echo $join ?>的投票情况：</dt>
			<div class ="vote_opts">
			<?php if(!empty($$vote_log)){ foreach($vote_log as $key => $vo)	{?>
				<?php if( true === $vo['isFriend'] || true === $vo['admin'] || true == $vo['Show'] ){ ?>
				<dd><div class="left mt5" style="width:20px;"><?php if( true == $vo['isFriend'] ){ ?><img src="../Public/images/haoyou.gif"><?php } ?><?php if( $mid == $vo['uid'] ){ ?><img src="../Public/images/arrow_y.gif"><?php } ?>&nbsp;</div><div class="left" style="width:760px;"><a href="__TS__/space/{$vo.uid}">{$vo.name}</a> {$vo.cTime|friendlyDate}&nbsp;&nbsp;投票给“{$vo.opts}”</div> </dd>
				<?php } ?>
			<?php }} ?>
			</div>
			<?php } ?>
		</dl>
		<div class="c"></div>
	</div>


	<div style="width:637px"><?php $this->widget('WComment',array('items'=>array('type'=>'vote','appid'=>$vote['id'],'mid'=>$vote['uid'],'face'=>User::model()->getUserFace($mid),'role'=>1 )));?></div>
</div>