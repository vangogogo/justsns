<?php
$this->breadcrumbs=array(
        '星座'=>array('/astro'),
        CHtml::encode($astro->astro_name),
);
?>
<script>
	$(function() {
		//$( "#week-tabs,#month-tabs" ).tabs();
		$( "#astro_datepicker").datepicker({
            'dateFormat':'yy-mm-dd',
            'gotoCurrent':true,
            'maxDate': '+1d'
		}).change(function() {
            var day = $(this).attr('value');
            var url = "<?php echo $_GET['astro_id'];?>-<?php echo $_GET['name'];?>-"+day+".html";
            redirect(url);
        });
	});
</script>

<div class="page-header">
	<h1><a href="<?php echo $astro->getUrl();?>" title="<?php echo CHtml::encode($astro->astro_name)?> <?php echo $astro->astro_date?>"><?php echo CHtml::encode($astro->astro_name)?></a> <?php echo $astro->astro_name_en;?>
	<input type="text" id="astro_datepicker" class="t_input " style="width:76px" value="<?php echo date('Y-m-d',strtotime($d_day));?>" />
	</h1>
	<div class="pull-right">
		<?php $this->widget('WUserCollect',array('object_id'=>$astro->primaryKey,'object_type'=>'astro'));?>
		<?php echo CHtml::link('返回',array('/astro'),array('class'=>'btn info'));?>
	</div>
</div>

<div class="content">
	<div class="row">
	    <div class="span3">
			<div class="media-grid">
	        <a href="<?php echo $astro->getUrl();?>"
	        title="<?php echo CHtml::encode($astro->astro_name)?>"> 
	        <img src="<?php echo Yii::app()->request->baseUrl.'/images/astros/'.$astro->astro_id.'.gif';?>" alt="<?php echo CHtml::encode($astro->astro_name)?>" title="<?php echo CHtml::encode($astro->astro_name.' '.$astro->astro_date)?>" class="astro-thumbnail" /> </a>
			</div>
	
			<div class="picInfo-more cf">
				<div class="picInfo-more-c1">
				</div>
			</div>
	    </div>
	    <div class="span7">
			<div class="row ginfo">
				<div class="span4">
					<ul class="unstyled">
						<li class="row">
							<span class="span1  success">爱情</span><?php $star=$day->love;; // 默认 4星. ?>
							<span class="span2 istar"><span class="star<?php echo $star ?>"></span></span>
						</li>
						<li class="row">
							<span class="span1 success">工作</span><?php $star=$day->work;; // 默认 4星. ?>
							<span class="span2 istar"><span class="star<?php echo $star ?>"></span></span>
						</li>
						<li class="row">
							<span class="span1 success">金钱</span><?php $star=$day->money;; // 默认 4星. ?>
							<span class="span2 istar"><span class="star<?php echo $star ?>"></span></span>
						</li>
						<li class="row">
							<span class="span1 success">总体</span><?php $star=$day->sum;; // 默认 4星. ?>
							<span class="span2 istar"><span class="star<?php echo $star ?>"></span></span>
						</li>
					</ul>
				</div>
				<div class="span3">
					<ul>
						<li><span class="label success">幸运星座:</span> <a href="#"><?php echo $day->luck_astro;?></a></li>
						<li><span class="label success">幸运颜色:</span> <a href="#"><?php echo $day->luck_color;?></a></li>
						<li><span class="label success">幸运号码:</span> <a href="#"><?php echo $day->luck_num;?></a></li>
						<li><span class="label success">健康指数:</span> <a href="#"><?php echo $day->health;?>%</a></li>
						<li><span class="label success">事业指数:</span> <a href="#topicList"><?php echo $day->bussiness;?>%</a></li>
					</ul>
				</div>
			</div>
	    </div>
	</div>

<dl class="astro_dl">
	<?php if(!empty($day->content)):?>
	<dt><span class="label important">当日运程</span> <?php #if(empty($day) AND 0) echo '暂无'; else $this->widget('WStarRating',array('object_type'=>'astro_day','object_id'=>$day->primaryKey)); ?></dt>
	<dd>
		<p><?php echo $day->content; ?></p>
	</dd>
	<?php endif;?>
	<?php if(!empty($week)):$model = $week;$items = '';$pre='week';?>
	<dt><span class="label important">本周运程</span> <?php #if(empty($week) AND 0) echo '暂无'; else  $this->widget('WStarRating',array('object_type'=>'astro_week','object_id'=>$week->primaryKey));?></dt>
	<dd>
		<div id="week-tabs">
		<?php 
			$arr = array(
				'sum_content'=>'总体',
				'study_content'=>'学习',
				'work_content'=>'工作',
				'love_content'=>'恋爱',
				'love_content_no'=>'恋爱(无恋人)',
				'sex_content'=>'情感',
				'red_content'=>'红桃日',
				'black_content'=>'黑桃日',
			);
			foreach($arr as $attr => $title)
			{
				$star_attr = str_replace('_content','',$attr);
				$content = YiicmsHelper::CMarkdown($model->$attr);
				$item = array(
					'title'=>$title,
					'id'=>$pre.'_'.$attr,
					'content'=>$content,
				);
				$items[$title] = $item;
			}
		
			$this->widget('BootTabs', array(
		    'type'=>'tabs', // tabs or pills, defaults to tabs
		    'tabs'=>$items
		)); ?>
		</div>
	</dd>
	<?php endif;?>

	<?php if(!empty($month)):$model = $month;$items = '';$pre='month';?>
	<dt><span class="label important">每月运程</span> <?php #if(empty($month)) echo '暂无'; else  $this->widget('WStarRating',array('object_type'=>'astro_month','object_id'=>$month->primaryKey));?></dt>
	<dd>
		<div id="month-tabs">
		<?php
		$arr = array(
			'sum_content'=>'总体',
			'money_content'=>'财运',
			'love_content'=>'恋爱',
			'relax_way'=>'放松方式',
			'luck_way'=>'幸运星',
		);
		foreach($arr as $attr => $title)
		{
			$star_attr = str_replace('_content','',$attr);
			$content = YiicmsHelper::CMarkdown($model->$attr);
			$item = array(
				'title'=>$title,
				'id'=>$pre.'_'.$attr,
				'content'=>$content,
			);
			$items[$title] = $item;
		}
			
		$this->widget('BootTabs', array(
		    'type'=>'tabs', // tabs or pills, defaults to tabs
		    'tabs'=>$items
		)); ?>
		</div>
	</dd>
	<?php endif;?>
</dl>
</div>

<div class="sidebar">
	<?php if(!empty($this->astros_list)):?>
	<ul class="pills">
		<?php foreach($this->astros_list as $astro):?>
		<li <?php if($astro->primaryKey == @$_GET['astro_id']) echo 'class="active"'?>>
        <a href="<?php echo $astro->getUrl();?>" title="<?php echo CHtml::encode($astro->astro_name)?> <?php echo $astro->astro_date?>"><?php echo CHtml::encode($astro->astro_name)?>
        </a><span class="astro_date2"><?php echo $astro->astro_date?></span>
		</li>
        <?php endforeach;?>
	</ul>
	<?php endif;?>
</div>