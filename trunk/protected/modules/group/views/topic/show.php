<h1><?php echo $topic['title']?></h1>
<div class="grid_15 suffix_1">
	<div class="height1"></div>
	<table class="topic_content">
		<tr>
			<td width="65">
				<img title="<?php echo User::model()->getUserName($topic['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
			</td>
			<td>
				<h3><?php echo friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>　
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
						<?php echo User::model()->getUserName($topic['uid']);?>
					</a>
				</h3>
				<div class="content">
		            <?php
			            $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			            echo $topic->getTopicContent();
			            $this->endWidget();
		            ?>
				</div>
				<div class="height2"></div>
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
					<td width="65">
						
							<a href="<?php echo $this->createUrl('/space/',array('uid'=>$post['uid']));?>"  class="tips">
								<img title="<?php echo User::model()->getUserName($post['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
							</a>

					</td>
					<td>
						<h4><?php echo friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>　
							<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
								<?php echo User::model()->getUserName($topic['uid']);?>
							</a>
						</h4>
						<div id="comment_<?php echo$post['id'];?>" class="content">
	                    <?php
		                    $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
		                    echo h(stripslashes($post['content']));
		                    $this->endWidget();
	                    ?>

						</div>
						<textarea id="comment_txt_<?php echo$topic['id'];?>" style="display:none;">子非鱼，焉知鱼之乐。</textarea>
						<div id="operate_<?php echo$topic['id'];?>" class="operate">
							<?php if($topic['lock'] == 1 || !$actor_level || 1){ ?>   <?php } else{  ?>
							<a href="javascript:quote({$post['id']})">引用</a> ┊ 
							<?php } ?>
							<?php if($this->mid == $post['uid'] || $isadmin){ ?>
								<?php //echo CHtml::link('编辑',array('topic/editPost','pid'=>$post['id']),array('class'=>'a_confirm_link'));?>
								<?php echo CHtml::link('> 删除',array('topic/doDelPost','tid'=>$post['tid'],'pid'=>$post['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?>
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

	<?php if(!Yii::app()->user->isGuest AND $post_access):?>
		<?php if(!empty($_GET['post'])){?>
		<div class="color-gray">
			<?php echo CHtml::link('继续发言',array('topic/show','tid'=>$topic['id'],'page'=>$page,'#'=>'last'),array('id'=>'last'));?>
		</div>
		<?php }else{?>
			<h2>你的回应</h2>
		<div class="topic_reply" id="last">
			<?php $this->widget('WPost', array('model'=>$GroupPost,)); ?>
		</div>

		<?php }?>
    <?php endif;?>

</div>	
<div class="grid_8">
	<?php $this->widget('WGroupTopicSidebar',array('gid'=>$group['id'])); ?>
</div>
