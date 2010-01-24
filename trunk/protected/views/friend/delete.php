<div class="grid_20">
<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::activeHiddenField($model,'fuid');?>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td height="22">将<?php echo $model->fusername?>从我的好友中删除？</td>
		</tr>
		<tr>
			<td align="right"  height="25"><input name="" type="image" src="images/system/submit.gif" /></td>
		</tr>
	</table>
<?php echo CHtml::endForm(); ?> 
</div>