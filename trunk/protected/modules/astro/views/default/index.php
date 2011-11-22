<?php
$this->breadcrumbs=array(
	Yii::t('bootstrap', 'Astro'),
);
?>
<div class="page-header">
	<h1>12星座</h1>
</div>
<div class=" media-grid">
<?php foreach($astros as $astro):?>
<div class="">
    <h3>
        <a href="<?php echo $astro->getUrl();?>" title="<?php echo CHtml::encode($astro->astro_name)?> <?php echo $astro->astro_date?>"><?php echo CHtml::encode($astro->astro_name)?>
        </a><span class="astro_date"><?php echo $astro->astro_date?></span>
    </h3>
    <a href="<?php echo $astro->getUrl();?>"
        title="<?php echo CHtml::encode($astro->astro_name)?>"> 
        <img
        src="<?php echo Yii::app()->request->baseUrl.'/images/astros/'.$astro->astro_id.'.gif';?>"
        alt="<?php echo CHtml::encode($astro->astro_name)?>"
        title="<?php echo CHtml::encode($astro->astro_name.' '.$astro->astro_date)?>"
        class="thumbnail astro-thumbnail"  /> </a>
</div>
<?php endforeach;?>
</div>
