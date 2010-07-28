<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<?php

Yii::app()->clientScript->registerCoreScript('jquery');

//MAIN JS
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/yiisns.js');
//pnotify
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/pnotify/jquery.pnotify.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/pnotify/jquery.pnotify.default.css');

//Blueprint CSS Framework 0.9
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/screen.css');

//MAin CSS
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/group2.css');

		?>
		<title>
			<?php echo CHtml::encode($this->pageTitle); ?>
		</title>
		
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css" />
		
	</head>
	<body>
		<div id="head">
			<div id="logo">
				<a href="/"><img src="/images/logo.gif" alt="<?php echo CHtml::encode(Yii::app()->name); ?>" border="0" /></a>
			</div>
			<div id="headright">
				<div id="hello">
					<?php if(Yii::app()->user->isGuest) {?>
						<?php echo CHtml::link('注册',array('/site/reg'));?> ┆ 
						<?php echo CHtml::link('登陆',array('/site/login'));?> ┆ 
						<?php echo CHtml::link('帮助',array('/site/help'));?>
					<?php }else{?>
						<?php echo CHtml::link('管理',array('/admin'));?> ┆ 
						<?php echo CHtml::link('邀请',array('/invite'));?> ┆ 
						<?php echo CHtml::link('账号',array('/account'));?> ┆ 
						<?php echo CHtml::link('资料',array('/info'));?> ┆ 
						<?php echo CHtml::link('退出',array('/site/logout'));?>
					<?php }?>
				</div>
				<div id="menu">
					<?php
					if(!Yii::app()->user->isGuest) {
						$friend_item = array(
							array('label'=>'我的好友', 'url'=>array('/friend/index')),
							array('label'=>'好友屏蔽', 'url'=>array('/friend/ping')),
							array('label'=>'访问脚印', 'url'=>array('/friend/track')),
							array('label'=>'查找朋友', 'url'=>array('/friend/find')),
							array('label'=>'邀请好友', 'url'=>array('/invite')),
						);
						$notice_item = array(
							array('label'=>'短消息', 'url'=>array('/notify/inbox')),
							array('label'=>'系统通知', 'url'=>array('/notify/index','type'=>'system')),
							array('label'=>'好友请求', 'url'=>array('/notify/index','type'=>'friend')),
							array('label'=>'留言板', 'url'=>array('/site/page')),
						);
						$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'首页', 'url'=>array('/site/index')),
							array('label'=>'个人空间', 'url'=>array('/space', 'uid'=>Yii::app()->user->id)),
							array('label'=>'好友', 'url'=>array('/friend/index'),'linkOptions'=>array('class'=>'ico_arrow'), 'items' => $friend_item),
							array('label'=>'小组', 'url'=>array('/group')),
							array('label'=>'信息', 'url'=>array('/notify/inbox'),'linkOptions'=>array('class'=>'ico_arrow'), 'items' => $notice_item),
						),
						'submenuHtmlOptions'=>array('class'=>'dropmenu'),
						));
					}
					else
					{
						$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'首页', 'url'=>array('/site/index')),
							array('label'=>'随便看看', 'url'=>array('/site/contact')),
						),
						'submenuHtmlOptions'=>array('class'=>'dropmenu'),
						));
					}
					 ?>
				</div>
			</div>
		</div>
		<div class="clear01">
		</div>
		<div id="maincon">
			<?php echo $content?>
		</div>
		﻿
		<div class="height02 clear01">
		</div>
		<div id="foot">
			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> by LockPHP.
				All Rights Reserved.
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->
		</div>
	</body>
</html>
