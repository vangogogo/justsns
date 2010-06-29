<?php foreach($comments as $key => $comment): ?>


<div class="ReleaseBlock" id="c<?php echo $comment->id; ?>">
	<div class="tagRelease">
	<div class="tagReleasetag">回复<?php echo $key+1?></div>
	<div class="tagReleaseTime"><?php echo date('Y-m-d H:i:s',CHtml::encode($comment->ctime)); ?></div>
	<div class="clear"></div>
</div>
	<div class="ReleaseBorder">
	<div style="border-bottom:#ccc 1px solid;">
		<div class="ForumPicture"><img src="images/pic3.jpg" /></div>
		<ul class="ForumInformation">
			<li>barcorner</li>
			<li>糖尿病2型</li>
			<li>发布<a href="#">21个话题</a>，<a href="#">21个求助</a></li>
			<li>得到<a href="#">32个感谢</a></li>
		</ul>
		<div class="clear"></div>
		</div>
	<div class="ForumContent">
    <?php echo $comment->content; ?>	
	<?php if(!empty($comment->attach)){ ?>
		附件：<a href="#">糖尿病患者的饮食注意事项.txt</a>
    <?php }?>
	
	</div>
	<ul class="midContentMid BorderNone ForumReply">
		<li style="width:110px;">
			<div style="width:110px;"><a href="#gotoreplay"><img src="images/system/Reply.gif" /></a></div>
		</li>
		 <li>
		 	<div><a href="#"><img src="images/system/thanks.gif" /></a></div>
		</li>
	</ul>
	</div>

</div>
<?php endforeach; ?>

<div class="ForumPage">
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>

