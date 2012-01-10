<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
		'httpEquivs'=>array(
			#'Content-Type'=>'text/html; charset=utf-8',
			#'Content-Language'=>'en-US'
		),
		'defaultDescription'=>'YII实验基地,创造个人价值.',
		'defaultKeywords'=>'yiis, yii, sae, sina, php, cache, mysql, astro, sns, demo',
	)); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<?php

	
	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	
	Yii::app()->bootstrap->registerCoreCss();
	Yii::app()->bootstrap->registerScriptFile('jquery.ui.bootwidget.js');
	Yii::app()->bootstrap->registerScriptFile('jquery.ui.bootmodal.js');

	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.css');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/yiisns.js');
    #$cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
    $cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css');
?>
 
<?php 
/*
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20356935-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
*/
?>
</head>
<body>
<?php $this->renderDynamic('widget', 'WTopBar', array(), true);//动态缓存 ?>

<div class="container">

	<?php if (0 AND isset($this->breadcrumbs) AND !empty($this->breadcrumbs)):?>
		<?php $this->widget('ext.bootstrap.widgets.BootCrumb',array(
			'links'=>$this->breadcrumbs,
			'separator'=>'/',
		)); ?>
	<?php endif?>

	<?php echo $content; ?>
	
	<!-- start.footer -->
	<div style="clear:both"></div>
	<footer>
		<p class="pull-right"><a href="#">返回顶部</a></p>
		<p>
		Copyright &copy; <?php echo date('Y'); ?> by <a href="http://blog.lockphp.com" target="_blank">LockPHP</a>.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
		</p>
	</footer>
	<!-- end.footer -->
</div>
</body>
</html>
