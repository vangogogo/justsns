<?php /*$this->widget('application.extensions.ckeditor.CKEditor', array(
	'model'=>$model,
	'name'=>'content',
	'language'=>Yii::app()->language,
	'editorTemplate'=>'basic',
	'skin'=>'v2',
));*/ ?>
<?php echo CHtml::activeTextArea($model,'content');?>
<br/>
<?php echo CHtml::activeHiddenField($model,'gid');?>
<?php echo CHtml::activeHiddenField($model,'tid');?>
<input  type="submit" class="btn_b mt5"  value="发送" id="send_reply"/>