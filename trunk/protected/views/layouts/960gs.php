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
	$cs->registerCssFile('/css/style.css');

	//$cs->registerCssFile('/css/group.css');
	//$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/sns.css');

?>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/flick/jquery-ui.css" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->

</head>

<body>

<?php $this->renderDynamic('widget', 'WTopBar', array(), true);//动态缓存 ?>
<div class="container_24">
	<h2>24 Column Grid</h2>

		<!-- header -->
		<div class="header">
			<div class="logo i-a-sn fl"><a href="http://<?php echo SUB_DOMAIN_main;?>" title="返回首页">hello world</a></div>

			<!-- menu -->
			<div class="menu cb i-a-sn i-a-b">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'首页', 'url'=>array('/')),
							array('label'=>'影像', 'url'=>array('/movie')),
							array('label'=>'小组', 'url'=>array('/group/group/index')),
							array('label'=>'个人空间', 'url'=>array('/space')),
							array('label'=>'使用帮助', 'url'=>array('/help'),itemOptions=>array('class'=>'help')),

						),
					)); ?>
			</div>
			<!-- /menu -->
		</div>
		<!-- /header -->

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