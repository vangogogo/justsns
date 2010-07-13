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
						<span class="color-green">2010-05-10 14:19:47</span>
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
				&gt; <a href="http://www.douban.com/group/sz80/">回深圳80后小组</a>
			</p>
			<br>
			<!-- douban ad begin -->
			<div id="google_ads_slot_group_topic_new_top_right">
				<iframe width="310" scrolling="no" height="188" frameborder="0" id="google_ads_slot_iframe_group_topic_new_top_right" class="mb20">
				</iframe>
			</div>
			<!-- douban ad end --><h2 class="usf">最新话题:</h2>
			<div class="indent">
				<p class="pl ul">
					<a title="最近很喜欢吃，，，怎么办" href="http://www.douban.com/group/topic/12663191/">最近很喜欢吃，，，怎么办</a>
					&nbsp; <span class="pl">(EC在等) </span>
				</p>
				<p class="pl ul">
					<a title="感动每一个人的礼物！" href="http://www.douban.com/group/topic/12665856/">感动每一个人的礼物！</a>
					&nbsp; <span class="pl">(小月) </span>
				</p>
				<p class="pl ul">
					<a title="突然发现下班后挺无聊的" href="http://www.douban.com/group/topic/12665513/">突然发现下班后挺无聊的</a>
					&nbsp; <span class="pl">(偌大的世界) </span>
				</p>
				<p class="pl ul">
					<a title="求助求便宜的电影票" href="http://www.douban.com/group/topic/12665332/">求助求便宜的电影票</a>
					&nbsp;<span class="pl">(潜龙勿用) </span>
				</p>
				<p class="pl ul">
					<a title="哪些瞬间让你决定跟定你的爱人？" href="http://www.douban.com/group/topic/11640953/">哪些瞬间让你决定跟定你的爱人？</a>
					&nbsp; <span class="pl">(樱菲妮媂) </span>
				</p>
				<p class="pl ul">
					<a title="这几天突然地对一个女生产生很大的兴趣&mdash;&mdash;爱情来了吗？" href="http://www.douban.com/group/topic/12651835/">这几天突然地对一个女生产生很大的兴趣&mdash;&mdash;爱情来了吗...</a>
					&nbsp; <span class="pl">(EERF) </span>
				</p>
				<p class="pl ul">
					<a title="80后的我在白石洲卖新疆凉皮了，附近的同学们有空来尝尝吧~~~香的很！" href="http://www.douban.com/group/topic/11710379/">80后的我在白石洲卖新疆凉皮了，附近的同学们有空来尝...</a>
					&nbsp; <span class="pl">(那些花儿) </span>
				</p>
				<p class="pl ul">
					<a title="姐，笑而不语" href="http://www.douban.com/group/topic/12580451/">姐，笑而不语</a>
					&nbsp; <span class="pl">(小癫) </span>
				</p>
			</div>
		</div>
		<div class="extra">
			<a href="http://www.douban.com/misc/report?type=T&amp;uid=11285196" class="gact">&gt; 举报不良信息</a>
		</div>
	</div>
</div>
