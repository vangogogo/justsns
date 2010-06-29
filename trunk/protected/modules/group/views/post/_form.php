
<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::errorSummary($model); ?>

<div class="ForumInput"><?php echo CHtml::activeTextArea($model,'content',array('rows'=>'5','cols'=>'45','class'=>'Forumtextarea Topicstextarea','id'=>'textarea')); ?>
</div>
<div class="ForumPage"><a href="#">插入图片</a>&nbsp;&nbsp;<a href="#">添加附件</a>&nbsp;&nbsp;
</div>
<div style="text-align: right; padding: 10px 19px 10px 0;"><input
	type="image" src="images/system/Reply.gif" name="button" id="button"
	value="提交" /></div>
<?php echo CHtml::endForm(); ?>

