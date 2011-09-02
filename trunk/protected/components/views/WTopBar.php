<!-- top_bar -->
<div class="topbar">
	<div class="container_24">
	
		<div class="grid_16 usermenu">
			<ul>
				<li class=""><a href="http://www.yiiframework.com/doc/guide/1.1/zh_cn/index" title="Yii官方文档" target="_blank">Yii官方文档</a></li>
				<li class=""><a href="http://www.yiiframework.com/extensions" title="Yii官方扩展" target="_blank">Yii官方扩展</a></li>
				<li class="ls4"><a href="http://yiibook.com/" title="应用Yii1.1和PHP5进行敏捷Web开发" class="icm" target="_blank">Yii Book</a></li>
				<li class="ls4"><a href="http://yiidemo.sinaapp.com/" title="yii demo 原有的" class="icm" target="_blank">Yii Demo</a></li>

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
