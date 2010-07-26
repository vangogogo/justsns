<div id="topicmain">
	<h1><?php echo $topic['title']?></h1>
	<br/>
	<br/>
	<div id="topicmain_l">
		<div id="content">
			<table class="groupintro_t">
				<tr>
					<td width="76">
						<div id="image">
							<img title="<?php echo User::model()->getUserName($topic['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
						</div>
					</td>
					<td>
						<h3><?php echo friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>
							来自:
							<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
								<?php echo User::model()->getUserName($topic['uid']);?>
								</a>
						<br/>
						<div class="allcontent">
							<?php echo $topic->getTopicContent();?>
						</div>
						<br/>
						<div id="operate">
							<?php if($isadmin) { ?>
								<?php echo CHtml::link('编辑',array('topic/edit','tid'=>$topic['id']));?> ┊ 
								
								<?php $array = array('dist'=>'精华','top'=>'置顶','lock'=>'锁定');?>
								<?php foreach($array as $option => $name){ $title = $topic[$option]?'取消'.$name:$name;?>
									<?php echo CHtml::link($title,array('topic/doSwitch','tid'=>$topic['id'],'option'=>$option,'value'=>1-$topic[$option]),array('id'=>$option,'title'=>$title,'class'=>'a_alert_link'));?>
								<?php }?>
								
								<?php echo CHtml::link('删除',array('topic/doDelTopic','tid'=>$topic['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?> ┊
							<?php } elseif($this->mid == $topic['uid']) { ?>
							
								<?php echo CHtml::link('编辑',array('topic/edit','tid'=>$topic['id']));?> ┊
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
					</td>
				</tr>
			</table>
		</div>
		<div id="reply">
			<?php if(!empty($post_list)):?>
			<table class="groupintro_t">
				<?php foreach($post_list as $key => $post):?>
					<tr>
						<td width="76">
							<div id="image">
								<a href="<?php echo $this->createUrl('/space/',array('uid'=>$post['uid']));?>"  class="tips">
									<img title="<?php echo User::model()->getUserName($post['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
								</a>
							</div>
						</td>
						<td>
							<h4><?php echo friendlyDate('Y-m-d H:i:s',$post['ctime']);?>　
								<a href="<?php echo $this->createUrl('/space/',array('uid'=>$post['uid']));?>"  class="tips">
									<?php echo User::model()->getUserName($post['uid']);?>
								</a>
							</h4>
							<div class="height01">
							</div>
							<div id="comment_<?php echo $post['id']?>" class="allcontent">
								<?php echo h(stripslashes($post['content']));?>
							</div>
							<br>
							<div id="operate_<?php echo $post['id']?>" class="operate">
								<?php if($topic['lock'] == 1 || !$actor_level || 1){ ?>   <?php } else{  ?>
								<a href="javascript:quote({$post['id']})">引用</a> ┊ 
								<?php } ?>
								<?php if($this->mid == $post['uid'] || $isadmin){ ?>
									<?php //echo CHtml::link('编辑',array('topic/editPost','pid'=>$post['id']),array('class'=>'a_confirm_link'));?>
									<?php echo CHtml::link('删除',array('topic/doDelPost','pid'=>$post['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?>
								<?php } ?>
							</div>
						</td>
					</tr>
				<?php endforeach;?>
			</table>
			<?php endif ?>
		</div>

		<div class="clear01">
		</div>
		<h3 align="right">你好，请 <a href="/user/login.html">登录</a> 或 <a href="/user/register.html">注册</a></h3>
	</div>
	<div id="topicmain_r">
		<h2><a href="/group/">&gt; 小组首页</a></h2>
		<br/>
		<h2><?php echo CHtml::link('回到'.$group['name'],array('/group/group/show','gid'=>$topic['gid']));?></h2>
		<br/>
		<br/>
		<?php if(!empty($new_topics)):?>
		<h2>本组最近其他话题</h2>
		<div id="maincon_rl1">
			<ul>
				<?php foreach($new_topics as $topic):?>
				<li>
					<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']))?>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
		<br/>
		<?php endif ?>
		
	</div>
</div>