<?php if(!empty($mini_list)) foreach($mini_list as $vo){?>
<div class="Fli" id="Fli{$vo['id']}">
	<div class="c1">
		<span class="headpic50">
			<a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>"  class="tips">
				<img src="<?php echo user::model()->getUserFace($vo['uid'],'middle');?>" />
			</a>
		</span>
	</div>
	<div class="c2 bg_ico_arrow">
		<div class="MC bg01">
			<h4><a href="<?php echo $this->createUrl('/space/',array('uid'=>$vo['uid']));?>"><strong><?php echo $vo['name']?></strong></a><span class="time"><?php echo date('Y-m-d H:s',$vo['ctime'])?></span>|<span><a href="<?php echo $this->createUrl('/mini/friends',array('uid'=>$vo['uid']));?>"><?php echo Yii::t('c', 'more');?></a></span></h4>
			<p class="WB">
				<?php echo $vo['content'];?>
				<?php if( isset( $vo['replay'] ) && 2 < $vo['replay_numbel'] ){ ?>
					<a id="closeReplay<?php echo $vo['id']?>" href="###" onclick="closeReplay(<?php echo $vo['id']?>,<?php echo $vo['uid']?>)">收起回复</a>
				<?php }else{?>
					<a href="javascript:replay('false',<?php echo $vo['id']?>)"><?php echo Yii::t('c', 'reply');?></a>
				<?php }?>
			</p>
		</div>
		{:W('Replay',$vo['replay'])}
	</div>
	<div class="c"></div>
</div>
<?php }?>
<div class="baikeUserPage">
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>