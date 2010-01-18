<div class="user_app"><!-- 用户组件列表 begin -->
	<div class="user_app_top"></div>
	<div class="user_app_list">
		<ul>
			<li>
				<a href="{$app.url}" class="a14"><img src="{$app.icon}" />{$app.name}</a>
				<?php if(!empty($app["add_name"])) {?>
					<span><a href="{$app.add_url}">{$app.add_name}</a></span>
				<?php } ?>
			</li>
		</ul>
	</div>
	<div class="app_add"><a href="#">添加或删除组件</a></div>

	<?php if(!empty($ad["leftmenu"])) {?>
		<div class="ad_app">{$ad["leftmenu"]}</div>
	<?php } ?>

	<div class="user_app_btm"></div>
</div><!-- 用户组件列表 end -->
