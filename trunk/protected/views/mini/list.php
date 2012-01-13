<?php if(!empty($mini_list)) foreach($mini_list as $vo){?>
<div class="row Fli" id="Fli<?php echo $vo['id'];?>">
	<div class="c1">
		<?php $this->Widget('WUserFace',array('uid'=>$vo['uid']));?>
	</div>
	<div class="c2 bg_ico_arrow">
		<div class="MC bg01" id="MCG<?php echo $vo['id'];?>">
			<?php if(1){?>
				<p class="text">
					<span class="right mt5">
						<a id="d-<?php echo $vo['id'];?>" class="del" title="删除" href="javascript:deleteMini(<?php echo $vo['id'];?>)" style="display:none;">删除</a>
					</span>
					<span class="left">
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>">
							<strong><?php echo $vo['name'];?></strong>
						</a>
						<span class="time"><?php echo YiicmsHelper::friendlyDate('Y-m-d H:s',$vo['ctime'])?></span>
					</span>
				</p>
			<?php }else{?>
				<p class="text">
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>">
						<strong><?php echo $vo['name']?></strong>
					</a>
					<span class="time"><?php echo YiicmsHelper::friendlyDate('Y-m-d H:s',$vo['ctime'])?></span>|
					<span>
						<?php echo CHtml::link('更多',array('/mini/friends','uid'=>$vo['uid']));?>
					</span>
				</p>
			<?php }?>
			<p class="WB">
				<?php echo $vo['content'];?>
				<?php if( 2 < $vo['count'] ){ ?>
					<a id="closeReply<?php echo $vo['id']?>" href="###" onclick="closeReply(<?php echo $vo['id']?>,<?php echo $vo['uid']?>)">收起回复</a>
				<?php }else{?>
					<a href="javascript:reply('false',<?php echo $vo['id']?>)"><?php echo Yii::t('sns', 'reply');?></a>
				<?php }?>
			</p>
		</div>
		<?php $this->Widget('WReply',array('uid'=>$vo->uid,'id'=>$vo->id,'count'=>$vo->count,'first'=>$vo->first,'last'=>$vo->last));?>
	</div>

</div>
<?php }?>

	<div class="pagination">
    	<?php $this->widget('ext.bootstrap.widgets.BootPager',array('pages'=>$pages)); ?>
	</div>