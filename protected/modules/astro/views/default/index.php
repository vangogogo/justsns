<?php
$this->breadcrumbs=array(
	Yii::t('bootstrap', 'Astro'),
);
?>
<div class="page-header">
	<h1>12星座</h1>
</div>
<div class="content">
<ul class="media-grid">
<?php foreach($astros as $astro):?>
<li>
    

    <a href="<?php echo $astro->getUrl();?>"
        title="<?php echo CHtml::encode($astro->astro_name)?> <?php echo $astro->astro_date?>"> 
        <img
        src="<?php echo Yii::app()->request->baseUrl.'/images/astros/'.$astro->astro_id.'.gif';?>"
        alt="<?php echo CHtml::encode($astro->astro_name)?>"
        title="<?php echo CHtml::encode($astro->astro_name.' '.$astro->astro_date)?>"
        class="thumbnail astro-thumbnail"  /> 
        <br/>
        <?php echo CHtml::encode($astro->astro_name)?>

    </a>
</li>
<?php endforeach;?>
</ul>
</div>


<div class="sidebar">
        <?php
            if(!empty($this->astros_list)):
        ?>
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
