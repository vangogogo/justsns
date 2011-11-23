<?php
$this->breadcrumbs=array(
	Yii::t('bootstrap', 'Astro'),
);
?>

<div class="content2">
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


