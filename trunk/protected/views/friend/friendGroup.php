<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::activeHiddenField($model,'uid');?>
	<div class="confirm">
		<br/>
		分组的名称：<?php echo CHtml::activeTextField($model,'name',array('class'=>'Text'));?>
	</div>
	
	<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
	</div>
<?php echo CHtml::endForm(); ?> 
