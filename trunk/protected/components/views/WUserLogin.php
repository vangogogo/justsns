<div style="height:30px;">&nbsp;</div>

<style>
    .row label.rememberMe {
        width:200px;
    }
</style>

<?php if(!empty($model->errors)):?>
<div class="LoginBox_msg">
	<?php echo CHtml::errorSummary($model);?>
</div>
<?php endif;?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    #'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'email'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
     ),
)); ?>

    <?php echo $form->error($model,'email'); ?>
    <?php echo $form->error($model,'password'); ?>

	<div class="LoginBox border bg01">
		<h1 class="cBlue">登录{$site_opts.site_name}</h1>

            <div class="row">
                <?php echo $form->labelEx($model,'email'); ?><?php echo $form->textField($model,'email',array('class'=>'t_input')); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?><?php echo $form->passwordField($model,'password',array('class'=>'t_input')); ?>
            </div>
            <?php if(extension_loaded('gd')): ?>
            <div class="row">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <?php echo $form->textField($model,'verifyCode',array('class'=>'t_input')); ?><?php $this->widget('CCaptcha'); ?>
            </div>
            <?php endif; ?>

            <div class="row">
                <label> </label><?php echo $form->checkBox($model,'rememberMe'); ?> <?php echo $form->labelEx($model,'rememberMe',array('class'=>'rememberMe')); ?>
            </div>
            <div class="row">
                <label> </label><?php echo CHtml::submitButton('登录',array('class'=>'btn')); ?> <a href="__URL__/sendpass">取回密码</a>
            </div>

	</div> 
<?php $this->endWidget();?>
<div class="LoginBox_btm">
	还没有开通你的{$site_opts.site_name}帐号？ <br />
	<?php echo CHtml::link('立刻加入',array('site/reg'),array('class'=>'U f14px'));?>
</div>
