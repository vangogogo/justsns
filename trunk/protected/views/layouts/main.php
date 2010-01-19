<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

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


	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
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
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			)); ?>
		</div><!-- mainmenu -->
			
	</div><!-- header -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
