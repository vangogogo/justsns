<div class="cr"><!-- cr begin  -->
		<div class="aside">
			<p class="pl2">
				&gt; <?php echo CHtml::link('回到'.$group['name'],array('/group/group','gid'=>$topic['gid']));?>
			</p>
			<br>
			<!-- douban ad begin -->
			<div id="google_ads_slot_group_topic_new_top_right">

			</div>
			<!-- douban ad end -->
			<?php if(!empty($new_topics)):?>
			<h2 class="usf">最新话题:</h2>
			<div class="indent">
				<?php foreach($new_topics as $topic):?>
				<p class="pl ul">
					<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']))?>
					&nbsp; <span class="pl"> </span>
				</p>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		</div>
		<div class="extra">
			
		</div>
</div><!-- cr end  -->
