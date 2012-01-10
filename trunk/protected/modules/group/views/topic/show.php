<div class="page-header">
	<h1>
	<?php
		echo $topic->getTopicTitle();
	?>
	</h1>
</div>

<div class="content">
	<div class="height1"></div>
	<table class="topic_content">
		<tr>
			<td width="80">
				<?php $this->widget('WUserFace',array('uid'=>$topic['uid'])); ?>
			</td>
			<td>
				<h3><?php echo YiicmsHelper::friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>　
					<a href="<?php echo $this->createUrl('/space/index',array('uid'=>$topic['uid']));?>"  class="tips">
						<?php echo $topic->user->getUserName();?>
					</a>
				</h3>
				<div class="">
		            <?php
			            YiicmsHelper::CMarkdown($topic->getTopicContent());
		            ?>
				</div>
				<div class="height2"></div>
				<div id="operate">
				
					<?php if($this->module->isGroupAdmin OR Yii::app()->user->checkAccess('UserUpdateOwn', array('uid'=>$topic->uid))):?>
						<?php echo CHtml::link('编辑',array('topic/update','tid'=>$topic['id']));?> ┊
						<?php echo CHtml::link('删除',array('topic/doDelTopic','tid'=>$topic['id']),array('class'=>'a_confirm_link','data-title'=>'真的要删除 发言？'));?> ┊
					<?php endif; ?>
									
					<?php if($this->module->isGroupAdmin) : ?>
						
						<?php $array = array('dist'=>'精华','top'=>'置顶','lock'=>'锁定');?>
						<?php foreach($array as $option => $name){ $title = $topic[$option]?'取消'.$name:$name;?>
							<?php echo CHtml::link($title,array('topic/doSwitch','tid'=>$topic['id'],'option'=>$option,'value'=>1-$topic[$option]),array('id'=>$option,'title'=>$title));?> ┊ 
						<?php }?>
					<?php endif; ?>


                    <?php $this->widget('WUserCollect',array('object_id'=>$topic['id'],'object_type'=>'topic'));?>
				</div>
			</td>
		</tr>
	</table>

    <?php if(!empty($post_list)):?>
	<div  class=" prefix_1 clearfix">
		<table class="topic_reply">
			<?php foreach($post_list as $key => $post):?>
				<tr>
					<td width="80">
						<?php $this->widget('WUserFace',array('uid'=>$post['uid'])); ?>
					</td>
					<td>
						<h4><?php echo YiicmsHelper::friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>　
							<a href="<?php echo $this->createUrl('/space/index',array('uid'=>$topic['uid']));?>"  class="tips">
								<?php echo $post->user->getUserName();?>
							</a>
						</h4>
						<div id="comment_<?php echo$post['id'];?>" class="">
	                    <?php
	                   		YiicmsHelper::CMarkdown($post->content);
	                    ?>
						</div>
						<textarea id="comment_txt_<?php echo$topic['id'];?>" style="display:none;">子非鱼，焉知鱼之乐。</textarea>
						<div id="operate_<?php echo$topic['id'];?>" class="operate">
							<?php if($topic['lock'] == 1 || empty($actor_level) || 1){ ?>   <?php } else{  ?>
							<a href="javascript:quote({$post['id']})">引用</a> ┊ 
							<?php } ?>
							<?php if($this->mid == $post['uid']){ ?>
								<?php //echo CHtml::link('编辑',array('topic/editPost','pid'=>$post['id']),array('class'=>'a_confirm_link'));?>
								<?php echo CHtml::link('> 删除',array('topic/doDelPost','tid'=>$post['tid'],'pid'=>$post['id']),array('class'=>'a_confirm_link','data-title'=>'真的要删除 发言？'));?>
							<?php } ?>
						</div>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		
	</div>

	<?php $this->widget('CLinkPager',array('pages'=>$post_pages)); ?>

    <?php endif ?>

    <?php if(Yii::app()->user->isGuest):?>
	<div align="right">
		你好，请 <?php echo CHtml::link('登录',Yii::app()->user->loginUrl);?> 或 <a href="/user/register.html">注册</a> 后加入该小组发言
	</div>
    <?php endif;?>

	<?php if($this->module->isGroupMember):?>
		<?php if(!empty($_GET['post'])){?>
		<div class="color-gray">
			<?php echo CHtml::link('继续发言',array('topic/show','tid'=>$topic['id'],'page'=>$page,'#'=>'last'),array('id'=>'last'));?>
		</div>
		<?php }else{?>
			<?php if($topic->lock == 1):?>
				<h2>本贴已经被设置为 不允许回复 </h2>
			<?php else:?>
			<h2>你的回应</h2>
			<div class="topic_reply" id="last">
				<?php $this->widget('WPost', array('model'=>$GroupPost)); ?>
			</div>
			<?php endif;?>
		<?php }?>
    <?php endif;?>
</div>	
<div class="sidebar">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
