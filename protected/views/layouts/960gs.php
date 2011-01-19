<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>960 Grid System &mdash; Demo</title>
<?php
	$cs = Yii::app()->clientScript;
	
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	
	$cs->registerCssFile('/css/960gs/reset.css');
	$cs->registerCssFile('/css/960gs/960_24_col.css');
	
	//$cs->registerCssFile('/css/group.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/sns.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/group.css');

?>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->

</head>

<body>
<h1>
	<a href="http://960.gs/">960 Grid System</a>
</h1>
<div class="container_24">
	<h2>24 Column Grid</h2>
	<div class="menu">
		<a href="/">首页</a><a href="/video.html">影像</a><a href="/image.html">图画</a><a href="/game.html">游戏</a><a href="/audio.html">音频</a><a href="/text.html">文字</a><a href="/mix.html">杂碎</a><a href="/union.html">铺子</a><a href="/group/" class="selected">小组</a>
	</div>
	<?php echo $content; ?>

	<div class="clear"></div>
	
	<!-- start.footer -->
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by LockPHP.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
	</div>
	<!-- end.footer -->
</div>	
<!-- end .container_24 -->
</body>
</html>