<!-- top_bar -->
<div class="topbar">
	<div class="container_24">
	
		<div class="grid_16 usermenu">
			<ul>
			
				<li class="on"><a href="http://www.douban.com/">豆瓣社区</a></li>
			
				<li><a href="http://book.douban.com/">豆瓣读书</a></li>
			
				<li><a href="http://movie.douban.com/">豆瓣电影</a></li>
			
				<li><a href="http://music.douban.com/">豆瓣音乐</a></li>
			
				<li><a href="http://9.douban.com/" target="_blank">九点</a></li>
			
				<li><a href="http://douban.fm/" target="_blank">豆瓣电台</a></li>
			</ul>
		</div>
		<div class="grid_8 usermenu">
			<ul style="float:right;">
				<li class="ls4"><a href="http://<?php echo SUB_DOMAIN_uchome;?>/index.php" title="旧版本入口" >短消息</a></li>
				<?php if(Yii::app()->user->isGuest):?>
					<li class="ls2">
						<?php echo CHtml::link('登录',Yii::app()->user->loginUrl,array('id'=>'signin','class'=>""));?>
					</li>
				<?php else: ?>
					<li>
						<?php if(1==2): ?>
							<a href="javascript:void(0)" title="未读消息" class="icm msg"></a>
						<?php endif; ?>
					</li>
					<li class="user_panel">
						<a href="" title="" class="" onfocus= "this.blur()"><?php echo Yii::app()->user->name;?></a>
						<?php echo CHtml::link('退出',Yii::app()->params[logoutUrl],array('id'=>'logout','class'=>""));?>
						
					</li>
				<?php endif;?>
			</ul>
		</div>
	</div>
</div>
<!-- /top_bar -->