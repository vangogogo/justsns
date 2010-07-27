<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<?php

Yii::app()->clientScript->registerCoreScript('jquery');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/yiisns.js');
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
				<a href="/"><img src="/images/logo.gif" alt="有意思吧首页" border="0" /></a>
			</div>
			<div id="headright">
				<div id="hello">
				</div>
				<div id="menu">
					<ul>
						<li id="index">
							<a href="/">首页</a>
						</li>
						<li id="video">
							<a href="/video.html">影像</a>
						</li>
						<li id="image">
							<a href="/image.html">图画</a>
						</li>
						<li id="game">
							<a href="/game.html">游戏</a>
						</li>
						<li id="audio">
							<a href="/audio.html">音频</a>
						</li>
						<li id="text">
							<a href="/text.html">文字</a>
						</li>
						<li id="mix">
							<a href="/mix.html">杂碎</a>
						</li>
						<li id="union">
							<a href="/union.html">铺子</a>
						</li>
						<li id="group">
							<a href="/group/">小组</a>
						</li>
						<!--<li id="film"><a href="http://film.u148.net/" target="_blank">电影</a></li> -->
					</ul>
				</div>
			</div>
		</div>
		<div class="clear01">
		</div>
		<script type="text/javascript" language="javascript">
			$(function(){
				validateLogin();
			});
		</script>
		<script type="text/javascript" language="javascript">
			setHeader("group");
		</script>
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
