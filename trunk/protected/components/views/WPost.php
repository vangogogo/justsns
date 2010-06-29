<?php $this->widget('application.extensions.ckeditor.CKEditor', array(
	'model'=>$model,
	'name'=>'title',
	'language'=>Yii::app()->language,
	'editorTemplate'=>'basic',
	'skin'=>'v2',
)); ?>
<br/>
<?php echo CHtml::activeHiddenField($model,'gid');?>
<?php echo CHtml::activeHiddenField($model,'tid');?>
<input  type="submit" class="btn_b mt5"  value="发送" id="send_reply"/>