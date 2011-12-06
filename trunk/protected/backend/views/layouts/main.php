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
	Yii::app()->bootstrap->registerBootstrap();

	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	$cs->registerCssFile('/css/bootstrap.css');
    $cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css');
?>

<?php 
// tips
$this->widget('ext.bootstrap.widgets.BootTwipsy',array(
    'selector'=>'a[title]',
)); 
?>
</head>
<body>
<?php $this->renderDynamic('widget', 'WTopBar', array(), true);//动态缓存 ?>

<div class="container-backend" id="mainarea">

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