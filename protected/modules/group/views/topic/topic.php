<div class="groupBox">
	<div class="box1">
		<h3><span class="right mr5"><input type="button" id="BtnShare_1" onclick="sharePop('1','/thinksns/apps/group/index.php?s=/Topic','1')" class="BtnShare" value="分享"></span><span style="line-height: 30px;">主题：<?php echo $topic['title']?></span></h3>
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
						<?php echo CHtml::link('编辑',array('topic/edit','tid'=>$topic['id']),array('class'=>'a_confirm_link'));?> ┊ 
						
						<?php $array = array('dist'=>'精华','top'=>'置顶','lock'=>'锁定');?>
						<?php foreach($array as $option => $name){ $title = $topic[$option]?'取消'.$name:$name;?>
							<?php echo CHtml::link($title,array('topic/switch','tid'=>$topic['id'],'option'=>$option,'value'=>1-$topic[$option]),array('id'=>$option,'title'=>$title,'class'=>'a_alert_link'));?>
						<?php }?>
						
						<?php echo CHtml::link('删除',array('topic/doDelTopic','tid'=>$topic['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?> ┊
					<?php } elseif($this->mid == $topic['uid']) { ?>
					


						<?php echo CHtml::link('编辑',array('topic/edit','tid'=>$topic['id']),array('class'=>'a_confirm_link'));?> ┊
						<?php echo CHtml::link('删除',array('topic/doDelTopic','tid'=>$topic['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?> ┊
						
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
			<div class="c"></div>
		</div>
		<div class="li pt10 topline">
			<div class="left" style="width:8%;">
				<span class="headpic50">
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
						<img title="<?php echo User::model()->getUserName($topic['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
					</a>
				</span>
				<br />
			</div>
			<div style="width: 12%; overflow: hidden;" class="left lh30">
				<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
					<?php echo User::model()->getUserName($topic['uid']);?>
				</a>
				<br>
				<img alt="管理员" src="http://localhost/thinksns/public/themes/blue/images/icon/groupicon/admin.png">
			</div>
						
			<div class="left lh30" style="width:12%; overflow:hidden;">
			<a href="__TS__/space/{$post['uid']}">{$post['uid']|getUserName}</a> <BR>{$post['uid']|getUserGroupIcon}</div>
			<div class="left" style="width:80%">
			  <div class="cGray2 lh30">
				<div class="right"><php>$p = $_GET['p'] ? intval($_GET['p']) : 1; echo intval($p-1)*$limit+($key-1)</php>楼</div>
			  {$post['ctime']|friendlyDate}</div>
				<div class="btmlineD pb10 pt10 f14px" style="line-height:180%;">
				<div style="padding:0 50px 0 0; " id="reply_content">
					<php>if($post['quote']){ $qcontent = getPost($post['quote']);$qstr = "<a href='__TS__/space/$qcontent[uid]'>".getUserName($qcontent['uid']).'</a> 回复于：'.friendlyDate($qcontent['ctime']).'<br/>'.h($qcontent['content']); </php><div id="quotes">   {$qstr|stripslashes|ubb} </div>  <php>}</php>
					{$post['content']|stripslashes|ubb|h}
		
					<php>if($post['attach']) { $attach = unserialize($post['attach']);  </php>
					<volist name="attach" id="data">
					<php>$data = explode('|',$data);</php>
					<div class="adjunct_list">
		                            <h2>附件:</h2>
		                        <p class="cGray2"><a href="__TS__/Attach/index/id/{$data['0']}/uid/{$post['uid']}">{$data[1]}</a><p>
		                        </div>
					</volist>
				<php>}</php>
		
					</div>
				</div>
				<div class="lh35 alR">
				   <php>if($topic['lock'] == 1 || !$actor_level){</php>   <php>} else{ </php>
					<a href="javascript:quote({$post['id']})">引用</a>
					<php>}</php>
		
					<php>if($mid == $post['uid'] || $isadmin){</php> ┊ <a href="__APP__/Topic/editPost/gid/{$gid}/pid/{$post['id']}">编辑</a> ┊ <a href="javascript:delPost({$gid},{$post['id']});">删除</a><php>}</php>
				</div>
			</div>
			<div class="c"></div>
		</div>		
		
		<div class="page">
		</div>
		<div class="lh30 alR topline">
			<?php echo CHtml::link('返回话题列表>>',array('group/discussion','gid'=>$topic['gid']));?>
		</div>
		<?php echo EHtml::beginForm(); ?>
			<div class="li">
				<div style="width: 20%;" class="left alR lh25">
					<strong>回复话题：</strong>
				</div>
				<div style="width: 80%;" class="left">
					<?php //$this->widget('WPost', array('model'=>$post,)); ?>
				</div>
			</div>
		<?php echo EHtml::endForm(); ?>
	</div>
</div>