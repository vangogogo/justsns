<!-- top_bar -->
<div class="topbar">
	<div class="container_24">
	
		<div class="grid_16 usermenu">
			<ul>
			
				<li class="on"><a href="http://www.douban.com/">豆瓣社区</a></li>

			</ul>
		</div>
		<div class="grid_8 usermenu">
			<ul style="float:right;">

				<?php if(Yii::app()->user->isGuest):?>
					<li class="ls2">
						<?php echo CHtml::link('登录',Yii::app()->user->loginUrl);?>
					</li>
					<li>
						<?php echo CHtml::link('注册',array('/user/registration'));?>
					</li>
				<?php else: ?>
					<li>
						<?php if(1==2): ?>
							<a href="javascript:void(0)" title="未读消息" class="icm msg"></a>
						<?php endif; ?>
					</li>
					<li class="user_panel">
                        <?php echo CHtml::link(Yii::app()->user->name,array('/user'),array());?>
						<?php echo CHtml::link('退出',array('/user/logout'),array('id'=>'logout','class'=>""));?>
					</li>
				<?php endif;?>
			</ul>
		</div>
	</div>
</div>
<!-- /top_bar -->
