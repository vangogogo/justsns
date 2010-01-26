<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::activeHiddenField($model,'uid');?>
	<div class="confirm">
		<br/>
		确定删除这个分组？？
	</div>	
	<div id="f_button" class="btm">
			<input type="submit" value="确 认" class="btn_b" name="input" />
	</div>	
<?php echo CHtml::endForm(); ?> 
