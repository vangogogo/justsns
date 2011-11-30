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

	<div class="sidebar" id="mtreeview">
		<?php
			#$this->widget('CTreeView',array('persist'=>'cookie','data'=>$data,'animated'=>'fast','htmlOptions'=>array('class'=>'filetree  treeview-famfamfam')));

			$this->widget('application.extensions.MTreeView.MTreeView',array(
				'collapsed'=>true,
				'animated'=>'fast',
				'persist'=>'cookie',
				//---MTreeView options from here
				'table'=>'menu_adjacency',//what table the menu would come from
				'hierModel'=>'adjacency',//hierarchy model of the table
				'conditions'=>array('visible=:visible',array(':visible'=>1)),//other conditions if any                                    
				'fields'=>array(//declaration of fields
					'text'=>'title',//no `text` column, use `title` instead
					'alt'=>'title',//skip using `alt` column
					'id_parent'=>'parent_id',//no `id_parent` column,use `parent_id` instead
					'position'=>'title',
					'task'=>false,
					'options'=>'options',
					'url'=>array('/menuAdjacency/view',array('id'=>'id'))
				),
				'template'=>'{icon}&nbsp;{text}',
				#'htmlOptions'=>array('class'=>'filetree  treeview-famfamfam')
				#'ajaxOptions'=>array('update'=>'#mtreeview-target')
			));
		?>
	</div>

	<div class="content" id="mtreeview-target">

	<?php if (isset($this->breadcrumbs) AND !empty($this->breadcrumbs)):?>
		<?php $this->widget('ext.bootstrap.widgets.BootCrumb',array(
			'links'=>$this->breadcrumbs,
			'separator'=>'/',
		)); ?>
	<?php endif?>

	<?php echo $content; ?>


	</div>


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