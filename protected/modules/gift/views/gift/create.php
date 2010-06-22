<?php include('_top.php'); ?>

<div class="grid_16"
	style="position: relative; z-index: 1;"><!--问候 begin-->
<div class="wenhou"><?php echo CHtml::beginForm(); ?>
<table width="630" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="120" align="right" height="30">问候送给：</td>
		<td><?php $this->widget('WFriendSelect'); ?></td>
	</tr>
	<tr>
		<td width="120" align="right" valign="top">选择问候：</td>
		<td>
		<div class="wenhouDIV"><?php if(!empty($gifts)) { ?> <?php if(is_array($gifts)) { foreach($gifts as $key => $value) { ?>
		<dl>
			<dt><label for="greeting_ids[<?php echo $value->id?>]"><?php echo CHtml::image($this->image_dir.$value->img,$value->name,array('title'=>$value->desc));?></label>
			</dt>
			<dd><input id="greeting_ids[<?php echo $value->id?>]"
				name="greeting_ids[<?php echo $value->id?>]" type="checkbox"
				value="<?php echo $value->id?>" /></dd>
		</dl>
		<?php } } ?> <?php } ?>
		<div class="clear"></div>
		</div>
		<div class="baikeUserPage"><?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
		</div>
		</td>
	</tr>
	<tr>
		<td width="120" align="right" valign="top" height="120">附言：</td>
		<td><?php echo CHtml::activeTextArea($model,'content',array('class'=>'wenhouInput2'));?>
		</td>
	</tr>
	<tr>
		<td width="120" align="right"></td>
		<td><?php echo CHtml::activeRadioButtonList($model,'access',$this->accessOptions,array('separator'=>'<br/>')); ?>
		</td>
	</tr>
	<tr>
		<td width="120" align="right" height="40"></td>
		<td align="right"><input type="image"
			src="images/system/sendWenhou.gif" name="button" id="button"
			value="提交" /></td>
	</tr>
</table>
		<?php echo CHtml::endForm(); ?></div>
</div>
