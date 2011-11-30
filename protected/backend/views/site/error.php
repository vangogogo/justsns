<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<script>
function Jump(){
	window.location.href = '<?php echo $url;?>';
}
document.onload = setTimeout("Jump()" , <?php echo $delay;?>* 1000);
</script>
      <div class="hero-unit">

        <a class="close" href="#">×</a>

        <h1>Error <?php echo $code; ?></h1>
        <p><?php echo CHtml::encode($message); ?></p>
        <p class="actions2">
			
			
				系统将在 <span class="warning"><?php echo $delay;?></span> 秒后自动跳转,如果不想等待,直接点击
				<a class="btn large" href="<?php echo $url;?>">这里</a> 跳转
				<br/>
				或者 <a class="btn danger large" href="/">返回首页»»</a>
			
		</p>        
    </div>