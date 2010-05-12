<div style="height:30px;">&nbsp;</div>
<div class="LoginBox_msg">
	<?php echo CHtml::errorSummary($model); ?>
</div>
	<div class="LoginBox border bg01">
		<h1 class="cBlue">登录{$site_opts.site_name}</h1>
			<?php echo CHtml::beginForm(); ?>
			<ul>	
				<li>
					<div class="l"><?php echo CHtml::activeLabelEx($model,'email'); ?></div>
					<div class="r">
						<?php echo CHtml::activeTextField($model,'email'); ?>
					</div>
				</li>
				<li>
					<div class="l"><?php echo CHtml::activeLabelEx($model,'password'); ?></div>
					<div class="r">
						<?php echo CHtml::activeTextField($model,'password'); ?>
					</div>
				</li>

				<?php if(extension_loaded('gd')): ?>
				<li>
					<div class="l"><?php echo CHtml::activeLabel($model,'verifyCode'); ?>:</div>
					<div class="r">
						<?php $this->widget('CCaptcha'); ?><br/>
						<?php echo CHtml::activeTextField($model,'verifyCode',array('class'=>'t_input')); ?>
					</div>
				</li>
				<?php endif; ?>

				<li>
					<div class="l">&nbsp;</div>
					<div class="r"> <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?> <?php echo CHtml::activeLabel($model,'rememberMe'); ?></div>
				</li>

				<li>
					<div class="l">&nbsp;</div>
					<div class="r">
						<?php echo CHtml::submitButton('登录',array('class'=>'btn_b')); ?> <a href="__URL__/sendpass">取回密码</a>
					</div>
				</li>
			</ul>
		<?php echo CHtml::endForm(); ?>
	</div> 
<div class="LoginBox_btm">
	还没有开通你的{$site_opts.site_name}帐号？ <br />
	<?php echo CHtml::link('立刻加入',array('site/reg'),array('class'=>'U f14px'));?>
</div>