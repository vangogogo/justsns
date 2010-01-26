<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::activeHiddenField($model,'fuid');?>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td height="22">确定解除和<?php echo $model->fusername?>的好友关系吗？？</td>
		</tr>
	</table>
<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
</div>	
<?php echo CHtml::endForm(); ?> 
