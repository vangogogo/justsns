    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        #'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'focus'=>array($model,'name'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
         ),
    )); ?>
    <?php echo CHtml::errorSummary($model);?>
    <div class="form">
	    <div class="row">
		    <?php echo $form->labelEx($model,'name'); ?>
		    <?php echo $form->textField($model,'name',array('class'=>'t_input')); ?>
            <?php echo $form->error($model,'name'); ?>
	    </div>
	    <div class="row">
		    <?php echo $form->labelEx($model,'type'); ?>
		    <?php echo $form->dropDownList($model,'type',array('open'=>'公开','close'=>'私密'),array('separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
            <?php echo $form->error($model,'type'); ?>
	    </div>
	    <div class="row">
		    <?php echo $form->labelEx($model,'cid0'); ?>
		    <?php echo $form->dropDownList($model,'cid0',$category_list,array('class'=>'t_input','empty'=>'请选择')); ?>
            <?php echo $form->error($model,'cid0'); ?>
	    </div>
	    <div class="row">
		    <label></label>
		    <?php echo $form->textArea($model,'intro',array('class'=>'t_input t_area')); ?>
		    <label></label>    <?php echo $form->error($model,'intro'); ?>
	    </div>
	    <div class="row">
            <label></label>
        <?php echo CHtml::submitButton('确认',array('class'=>'btn'));?>
        <input type="button" class="btn btn_w" onclick="history.back(-1);"value="取消" />
	    </div>
    </div>
    <?php $this->endWidget();?>
