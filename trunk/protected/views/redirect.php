<script>
function Jump(){
	window.location.href = '<?php echo $url;?>';
}
document.onload = setTimeout("Jump()" , <?php echo $delay;?>* 1000);
</script>

<div class="message<?php echo $type == 'success'?2:1; ?>">
	<div class="message_box">
		<p><?php echo $message;?></p>
		<p>系统将在 <span style="color:blue;font-weight:bold"><?php echo $delay;?></span> 秒后自动跳转,如果不想等待,直接点击 <a href="<?php echo $url;?>">这里</a> 跳转<br/>或者
		<a href="<?php echo __ROOT__;?>/">返回首页</a></p>
	</div>
</div>