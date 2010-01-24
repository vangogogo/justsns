<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

<?php

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->getClientScript()->registerScriptFile('js/jquery-ui-1.7.2.custom.min.js');
//colorbox
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/thickbox/thickbox.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/thickbox/thickbox.css');
// blueprint CSS framework
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/screen.css','screen, projection');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/print.css','print');

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/public.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/sns.css');
?>	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
</head>

<body>
<script>
$(document).ready(function() { 
	$('.dropmenu').parents('li').hover(
		function() {
			$(this).addClass("on");
			$(this).children('a').addClass("fb14");
		},
		function() {
			$(this).removeClass("on");
			$(this).children('a').addClass("fb14");
		}
	); 
	
}); 

</script>
<div class="container" id="page">

	<div id="header">
		<div id="logo" class="span-4"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<div id="mainmenu" class="span-21 last">
			<?php 
			
			$friend_item = array(
				array('label'=>'我的好友', 'url'=>array('/friend/index')),
				array('label'=>'好友屏蔽', 'url'=>array('/friend/ping')),
				array('label'=>'访问脚印', 'url'=>array('/friend/track')),
				array('label'=>'查找朋友', 'url'=>array('/friend/find')),
				array('label'=>'邀请好友', 'url'=>array('/friend/invite')),
			);
			$notice_item = array(
				array('label'=>'短消息', 'url'=>array('/site/index')),
				array('label'=>'系统通知', 'url'=>array('/site/page')),
				array('label'=>'好友请求', 'url'=>array('/site/contact')),
				array('label'=>'留言板', 'url'=>array('/site/page')),
			);
		$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'首页', 'url'=>array('/site/index')),
					array('label'=>'个人空间', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'好友', 'url'=>array('/friend/index'),'linkOptions'=>array('class'=>'ico_arrow'), 'items' => $friend_item),
					array('label'=>'随便看看', 'url'=>array('/site/contact')),
					array('label'=>'信息', 'url'=>array('/friend/index'),'linkOptions'=>array('class'=>'ico_arrow'), 'items' => $notice_item),
				),
				'submenuHtmlOptions'=>array('class'=>'dropmenu'),
			)); ?>
		</div><!-- mainmenu -->
		<div id="nav_sub">
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
	</div><!-- header -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by LockPHP.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
