<div id="content">
	<h1><?php echo $topic['title']?></h1>
	<div class="grid-16-8 clearfix">
		<div class="article">
			<div class="topic-content clearfix">
				<div class="user-face">
					<a href="http://www.douban.com/people/liuwenbo/"><img alt="快刀柔风" src="http://t.douban.com/icon/u1232885-5.jpg" class="pil"></a>
				</div>
				<div class="topic-doc">
					<h3>
						<span class="color-green"><?php echo $topic->ctime;?></span>
						<span class="pl20">来自: <a href="http://www.douban.com/people/liuwenbo/">快刀柔风</a>(极目疑天阔逆风验英雄)</span>
					</h3>
					<p>
						<?php echo $topic->getTopicContent();?>
					</p>
					<div id="rdialog-T-11285196" class="hidden">
						<form class="j a_rec_form" action="/j/recommend" method="post">
							<div style="display: none;">
								<input type="hidden" value="gz0c" name="ck">
							</div>
							<div class="rectitle">
								<span class="gact rr"><a onclick="close_dialog()" href="javascript:void(O)">x</a></span>
								<span class="m">向我的友邻推荐小组话题：关于对小组管理员及小组建设的未来展望</span>
								<span class="recsmr">摘要: 开题之前，身为组长，我必须得道一声迟来的祝福：热烈庆祝深圳80后小组男男...</span>
							</div>
							<div class="reccomment">
								<span class="pl">推荐语:</span>
								<textarea rows="3" name="comment" class="text">
								</textarea>
								<input type="hidden" value="T" name="type"><input type="hidden" value="11285196" name="uid">
								<div class="recsubmit">
									<input type="submit" value="确定"><input type="button" onclick="close_dialog();" value="取消">
								</div>
							</div>
						</form>
					</div>
					<div class="topic-opt clearfix">
						<span class="fright"><span id="T-11285196"><a name="rbtn-T-11285196-" class="j a_rec_btn " href="http://www.douban.com/people/huanghuibin/recs?add=T11285196"><img src="http://t.douban.com/pics/recommend.gif"></a></span></span> &nbsp;
						&nbsp;
					</div>
				</div>
			</div>
			<?php if(!empty($post_list)):?>
			<ul class="topic-reply">
				<?php foreach($post_list as $key => $post):?>
				<li class="clearfix">
					<div class="user-face">
						
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$post['uid']));?>"  class="tips">
							<img alt="<?php echo User::model()->getUserName($post['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>"  class="pil"/>
						</a>
					</div>
					<div class="reply-doc">
						<div class="bg-img-green">
							<h4><?php echo date('Y-m-d H:i:s',$post['ctime']);?> 
								<?php echo CHtml::link($topic['name'],array('space','uid'=>$topic['uid']));?> <?php //(恩，我从良了……)?>
							</h4>
						</div>
						<p>
							<?php echo h(stripslashes($post['content']));?>
						</p>
						<div class="group_banned">
							<?php if($this->mid == $post['uid'] || $isadmin){ ?>
								<?php //echo CHtml::link('编辑',array('topic/editPost','pid'=>$post['id']),array('class'=>'a_confirm_link'));?>
								<span class="gact hidden p_u1200493 p_u1232885 p_group_admin p_admin p_intern fright">&gt;
								<?php echo CHtml::link('删除',array('topic/doDelPost','pid'=>$post['id']),array('class'=>'a_confirm_link','title'=>'确认删除'));?>
								</span>
							<?php } ?>
						</div>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
			<h2>你的回应 &nbsp; ·&nbsp; ·&nbsp; ·&nbsp; ·&nbsp; ·&nbsp; ·</h2>
			<div class="txd">
				<form action="add_comment" method="post" name="comment_form">
					<div style="display: none;">
						<input type="hidden" value="gz0c" name="ck">
					</div>
					<textarea cols="54" rows="8" name="rv_comment" id="last">
					</textarea>
					<br>
					<input type="hidden" value="0" name="start"><input type="submit" value="加上去">
				</form>
			</div>
		</div>
		<div class="aside">
			<p class="pl2">
				&gt; <?php echo CHtml::link('回到'.$group['name'],array('group','gid'=>$group['id']));?>
			</p>
			<br>
			<!-- douban ad begin -->
			<div id="google_ads_slot_group_topic_new_top_right">

			</div>
			<!-- douban ad end -->
			<?php if(!empty($topics)):?>
			<h2 class="usf">最新话题:</h2>
			<div class="indent">
				<?php foreach($topics as $topic):?>
				<p class="pl ul">
					<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']))?>
					&nbsp; <span class="pl">(EC在等) </span>
				</p>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		</div>
		<div class="extra">
			
		</div>
	</div>
</div>
