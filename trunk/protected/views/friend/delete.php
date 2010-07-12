<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::activeHiddenField($model,'fuid');?>
<div class="confirm"><br />
确定解除和<?php echo $model->fusername?>的好友关系吗？？</div>
<div id="f_button" class="btm"><input type="submit" value="提 交"
	class="btn_b" name="input" /></div>
<?php echo CHtml::endForm(); ?>