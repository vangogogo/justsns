<script type="text/javascript" charset="utf-8">
	var mini_zishu = <?php echo $this->mini_zishu;?>;
	<?php 
		foreach($this->mini_ajax as $action):
	?>
	var <?php echo $action;?>_url = "<?php echo Yii::app()->createUrl('/mini/'.$action);?>";
	<?php endforeach;?>
</script>
<div class="edit_box">

	<div class="status_editor">
		<div class="status_edit2 item"><!-- 心情状态页显示编辑框 -->
			<textarea id ="mini-coment" name="content" rows="" class="t_input t_area t_mini " onkeyup="fot(this)" onkeydown="fot(this)"></textarea>
		</div>
		<input type="submit" class="btn btn_big" onclick="doAdd()" value="发布" /> <span id="mb-hint"><strong id="zishu"><?php echo $this->mini_zishu;?></strong>/<?php echo $this->mini_zishu;?></span>

	</div>
</div>
