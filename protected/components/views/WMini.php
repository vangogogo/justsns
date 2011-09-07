<script type="text/javascript" charset="utf-8">
	var mini_zishu = <?php echo $this->mini_zishu;?>;
	<?php 
		foreach($this->mini_ajax as $action):
	?>
	var <?php echo $action;?>_url = "<?php echo Yii::app()->createUrl('/mini/'.$action);?>";
	<?php endforeach;?>
</script>
<div class="edit_box">
	<div class="alR" style="width:350px; margin-bottom:-5px;">
		<span id="mb-hint"><strong id="zishu"><?php echo $this->mini_zishu;?></strong>/<?php echo $this->mini_zishu;?></span>
	</div>
	<div class="status_editor">
		<div style="float:left; width:100%" class="lh25">
			<span class="f14px fn cGray" id="mini-content"><?php echo $mini->content?></span>
			<span class="cGray2 fn f12px ml10" id="mini-time"><?php echo date('Y-m-d',$mini->ctime);?></span>
			<span class="f12px fn ml5"><a href="<?php echo Yii::app()->createUrl('/mini/my');?>">更多心情</a></span>
		</div>
		<div class="status_edit"><!-- 心情状态页显示编辑框 -->
			<div>
				<textarea id ="mini-coment" name="content" rows="" wrap="virtual" class="WB" onkeyup="fot(this)" onkeydown="fot(this)"></textarea>
			</div>
		<div class="phiz_box">
			<div class="phiz" style="display:none;top: 0px;left: 0px;">
				<?php if(!empty($icon_list)) foreach($icon_list as $i =>$value){?>
				<div class="ico_link">
					<img onclick="insert(this,<?php echo $i?>);" title="<?php echo $value->title?>" emotion="<?php echo $value->emotion?>" src="<?php echo Yii::app()->request->baseUrl.'/images/biaoqing/mini/'.$value->filename?>"/>
				</div>
				<?php }?>
			</div>
		</div>
		</div>
		<div class="left pt5 pl5"><input type="submit" class="btn btn_big" onclick="doAdd()" value="发布" /></div>
		<div class="c" ></div>
	</div>
</div>
