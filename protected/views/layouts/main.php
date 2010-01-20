<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php echo CGoogleApi::init(); ?>
 
<?php echo CHtml::script(
    CGoogleApi::load('jquery','1.3.2')
); ?>	
<?php
//colorbox
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/thickbox/thickbox.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/thickbox/thickbox.css');
// blueprint CSS framework
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/screen.css','screen, projection');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/print.css','print');

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/public.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/form.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/sns.css');
?>	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo" class="span-4"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<div id="mainmenu" class="span-21 last">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
				),
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
