<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
      <div class="hero-unit">

        <a class="close" href="#">×</a>

        <h1>Error <?php echo $code; ?></h1>
        <p><?php echo CHtml::encode($message); ?></p>
        <p class="actions2">
			<a class="btn danger large">返回首页»»</a>

		</p>        
    </div>