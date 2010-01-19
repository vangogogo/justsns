<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<?php $this->widget('UserLogin',array('model'=>$model)); ?>
