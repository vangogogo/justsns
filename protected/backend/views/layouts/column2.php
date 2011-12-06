<?php $this->beginContent('//layouts/main'); ?>


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

<?php $this->endContent(); ?>
