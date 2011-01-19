<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>960 Grid System &mdash; Demo</title>
<?php
	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	$cs->registerCssFile('/css/960gs/reset.css');
	$cs->registerCssFile('/css/960gs/text.css');
	$cs->registerCssFile('/css/960gs/960_24_col.css');
	$cs->registerCssFile('/css/960gs/reset.css');
	
	//$cs->registerCssFile('/css/group.css');
	
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/group2.css');
?>	
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css"/>
</head>

</head>
<body>
<h1>
	<a href="http://960.gs/">960 Grid System</a>
</h1>
<div class="container_24">
	<h2>
		24 Column Grid
	</h2>
	<?php echo $content; ?>

	<div class="clear"></div>
</div>
<!-- end .container_24 -->
</body>
</html>