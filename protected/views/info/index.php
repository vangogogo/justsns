<?php
 include('_top.php');
?>

    <?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'user-form',
	    'enableAjaxValidation'=>true,
	    #'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	    'clientOptions'=>array(
		    'validateOnSubmit'=>true,
	    ),
	    #'htmlOptions' => array('enctype'=>'multipart/form-data'),
    )); ?>

<div class="data jsvform" style="padding-top:30px;"><!-- 修改密码 begin  -->
<?php echo $form->errorSummary($model);?>
	<ul>
		<li class="btmline mb10 cGray2"><div style="width: 15%;" class="left alR">&nbsp;</div><div style="width: 50%;" class="left">&nbsp;</div><div style="width: 20%;" class="left">谁可以看见</div><div style="width: 15%;" class="left">在首页显示</div></li>
		<li>
			<div class="cl">用户名：<em>*</em></div>
			<div class="cc">
				<?php echo $form->TextField($model,'username',array('class'=>'t_input')); ?>
			</div>
			<div class="cr">
				<div class="success hidden">
					<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/fzcg_dh[1].gif" /></span>
				</div>
				<div class="error_info" style="position: relative;">
					<div>
						<span><img src="<?php echo Yii::app()->theme->baseUrl ?>/public/images/th_ju[1].gif" /></span>
						<div class="clue"><p class="error_content"></p><span class="clue_btm"></span></div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</li>


		<li><div class="cl"><em>&nbsp;</em></div><div class="cc">
			<?php echo CHtml::submitButton('确认修改',array('class'=>'btn_b')); ?>
			</div><div class="cr"></div>
			<div class="c"></div>
		</li>
	</ul>
</div><!-- 修改密码 end  -->
<?php $this->endWidget(); ?>
