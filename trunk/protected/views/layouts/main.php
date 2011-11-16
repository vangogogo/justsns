<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bootstrap, from Twitter</title>


	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le styles -->

	<style type="text/css">
	  body {
		padding-top: 60px;
	  }

	.container-fruid{zoom:1;margin-left:-20px;}.container-fruid:before,.container-fruid:after{display:table;content:"";zoom:1;}
	.container-fruid:after{clear:both;}
	.container-fruid>.sidebar{display: inline;float: left;margin-left: 20px;width: 280px;}
	.container-fruid>.content{display: inline;float: left;margin-left: 20px;width: 640px;}

	.media-grid img.big {width:180px;height:180px;}
	.media-grid img.small {width:50px;height:50px;}
	</style>

<?php
	$cs = Yii::app()->clientScript;

	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');

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
    #<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css" /> 

?>


<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
    'httpEquivs'=>array(
        'Content-Type'=>'text/html; charset=utf-8',
        #'Content-Language'=>'en-US'
    ),
    'defaultDescription'=>'YII实验基地,创造个人价值.',
    'defaultKeywords'=>'yiis, yii, sae, sina, php, cache, mysql, astro, sns, demo',
)); ?>

<?php echo Yii::app()->bootstrap->registerBootstrap(); ?>
<?php $this->widget('ext.bootstrap.widgets.BootTwipsy',array(
    'selector'=>'a[title]',
)); ?>
</head>

<body>
<?php $this->renderDynamic('widget', 'WTopBar', array(), true);//动态缓存 ?>

<div class="container">
	<div class="container-fruid">
	<?php echo $content; ?>

	<!-- start.footer -->
	</div>
	<footer>
		<p>
		Copyright &copy; <?php echo date('Y'); ?> by <a href="http://blog.lockphp.com" target="_blank">LockPHP</a>.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
		</p>
	</footer>
	<!-- end.footer -->
</div>
<!-- end .container_24 -->
</body>
</html>
