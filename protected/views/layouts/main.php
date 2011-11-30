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

    /*
    $cs->scriptMap=array(
        'jquery.js'=>false,
        'jquery.min.js'=>false,
        'jquery-ui.min.js'=>false,
        'jquery.ajaxqueue.js'=>false,
        'jquery.metadata.js'=>false,
        'jquery-ui.css'=>false,
    );

    echo CGoogleApi::init();
    echo CHtml::script(
        CGoogleApi::load('jquery','1.6.4') . "\n" .
        CGoogleApi::load('jqueryui','1.8.16')
        #CGoogleApi::load('jquery.ajaxqueue.js') . "\n" .
        #CGoogleApi::load('jquery.metadata.js')
    );
    */
    

    #$cs->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js');
    #$cs->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');

	##$cs->registerCssFile('/css/960gs/reset.css');
	#$cs->registerCssFile('/css/960gs/960_24_col.css');
	#$cs->registerCssFile('/css/style.css');


    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/yiisns.js');
    #$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/pnotify/jquery.pnotify.js');
    #$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/pnotify/jquery.pnotify.default.css');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.js');
    $cs->registerCssFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.css');

    $cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css');
?>

<?php 
// tips
$this->widget('ext.bootstrap.widgets.BootTwipsy',array(
    'selector'=>'a[title]',
)); 
?>
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
</head>

<body>
<?php $this->renderDynamic('widget', 'WTopBar', array(), true);//动态缓存 ?>

<div class="container">

	<?php if (isset($this->breadcrumbs) AND !empty($this->breadcrumbs)):?>
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