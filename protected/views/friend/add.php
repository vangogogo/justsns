<div class="grid_20">
	<?php if(!empty($msg)) {		echo $msg;?>

	<?php }else{?>	
	<div class="con">
	<?php echo CHtml::beginForm(); ?>
		<?php echo CHtml::activeHiddenField($model,'fuid');?>
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style="height: 120px;">

				<tr>
					<td height="100px" width="20%" valign="top">
						<img src="images/user/pic3.jpg"/>
					</td>
					<td width="80%" valign="top" id="tishi">
						<?php echo CHtml::activeTextArea($model,'note',array('class'=>'Text'));?>

											
					</td>
				</tr>
			   <!-- <tr id="f_group">
					<td>分组：</td>
					<td id="tishi"><select name="gid" id="gid">
											</select></td>
				</tr>-->

			
		</table>
			<input type="image" value="提交" id="button" name="button" src="images/system/btnRelease.gif"/>

			<input type="button"  value="取 消" class="btn_w" name="input2"/>		

		<div id="f_button" class="btm">

		</div>
	<?php echo CHtml::endForm(); ?> 
		</div>
	<?php }?>	
</div>