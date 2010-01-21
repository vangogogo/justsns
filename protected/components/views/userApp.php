<div class="user_app"><!-- 用户组件列表 begin -->
	<div class="user_app_top"></div>
	<div class="user_app_list">
		<?php if(!empty($apps)){?>
		<ul>
			<?php foreach($apps as $app){?>
			<li>
				<?php echo CHtml::link($app['name'],array('/'.$app['enname']),array('class'=>'a14'))?>
				<?php if(!empty($app["add_name"])) {?>
					<span>
						<?php echo CHtml::link($app['add_name'],array('/'.$app['enname'].'/create'))?>					
					</span>
				<?php } ?>
			</li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
	<div class="app_add"><a href="#">添加或删除组件</a></div>

	<?php if(!empty($ad["leftmenu"])) {?>
		<div class="ad_app">{$ad["leftmenu"]}</div>
	<?php } ?>

	<div class="user_app_btm"></div>
</div><!-- 用户组件列表 end -->
