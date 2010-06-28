<div class="groupBox">
	<div class="box1">
		<h3><span class="right mr5"><input type="button" id="BtnShare_1" onclick="sharePop('1','/thinksns/apps/group/index.php?s=/Topic','1')" class="BtnShare" value="分享"></span><span style="line-height: 30px;">主题：fdas </span></h3>
		<div class="li pt10">
			<div style="width: 8%;" class="left">
				<span class="headpic50">
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
						<img title="<?php echo User::model()->getUserName($topic['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
					</a>
				</span>
				<br>
			</div>
			<div style="width: 12%; overflow: hidden;" class="left lh30">
				<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
					<?php echo User::model()->getUserName($topic['uid']);?>
				</a>
				<br>
				<img alt="管理员" src="http://localhost/thinksns/public/themes/blue/images/icon/groupicon/admin.png">
			</div>
			<div style="width: 80%;" class="left">
				<div class="cGray2 lh30">
					<div class="right">
						楼主
					</div><?php echo friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>
				</div>
				<div style="line-height: 180%;" class="pb10 pt10 f14px">
					<div id="topic_content" style="padding: 0pt 50px 0pt 0pt;">
						<?php echo $topic->getTopicContent();?>
					</div>
				</div>
				<div class="lh35 alR toplineD">
				
					<?php if($isadmin) { ?>
						<a href="__URL__/edit/gid/<?php echo ($gid); ?>/tid/<?php echo ($topic['id']); ?>" title="编辑">编辑</a> ┊ 
						<?php if($topic['dist'] == 1) { ?><a id="dist" href="javascript:admin_set('undist');" title="取消精华">取消精华</a> <?php } else { ?> <a id="dist" href="javascript:admin_set('dist');" title="精华">设置精华</a> <?php } ?>┊ 
						<?php if($topic['top'] == 1) { ?><a id="top" href="javascript:admin_set('untop');" title="取消置顶">取消置顶</a> <?php } else { ?> <a id="top" href="javascript:admin_set('top');" title="置顶">置顶</a> <?php } ?>┊ 
						<?php if($topic['lock'] == 1) { ?><a id="top" href="javascript:admin_set('unlock');" title="取消锁定">取消锁定</a> <?php } else { ?> <a id="top" href="javascript:admin_set('lock');" title="锁定">锁定</a> <?php } ?>┊ 
						<a href="javascript:delThread(<?php echo ($gid); ?>,<?php echo ($tid); ?>);" title="删除">删除</a> ┊
					<?php } elseif($this->mid == $topic['uid']) { ?>
						<a href="__URL__/edit/gid/<?php echo ($gid); ?>/tid/<?php echo ($topic['id']); ?>" title="编辑">编辑</a> ┊
						<a href="javascript:delThread(<?php echo ($gid); ?>,<?php echo ($tid); ?>);" title="删除">删除</a> ┊
					<?php } ?>

					<?php if($topic['lock'] == 1 || !$actor_level){ ?>   <?php } else{ ?>
						<a href="javascript:quote(<?php echo ($topic['pid']); ?>)">引用</a> ┊
					<?php } ?>
				
					<?php if($isCollect && $this->mid) { ?>
						<a href="javascript:cancel_collect(<?php echo ($gid); ?>,<?php echo ($topic['id']); ?>)">取消收藏</a>

					<?php } elseif($this->mid) { ?>
						<a href="javascript:collect(<?php echo ($gid); ?>,<?php echo ($topic['id']); ?>)">收藏</a>
					<?php } ?>
				</div>
			</div>
			<div class="c">
			</div>
		</div>
		<div class="page">
		</div>
		<div class="lh30 alR topline">
			<?php echo CHtml::link('返回话题列表>>',array('group/discussion','gid'=>$topic['gid']));?>
		</div>
		<form onsubmit="return replySubmit();" id="replyForm" action="/thinksns/apps/group/index.php?s=/Topic/post" method="post">
			<div class="li">
				<div style="width: 20%;" class="left alR lh25">
					<strong>回复话题：</strong>
				</div>
				<div style="width: 80%;" class="left">
					
				</div>
			</div>
		</form>
	</div>
</div>