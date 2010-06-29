<?php if(!empty($subcomment)):?>
<div class="sublist pt5 clear" id="comm<?php echo $subcomment['id'];?>">
	<div class="left" style="width:50px;">
		<span class="pic38">
			<a href="<?php echo $this->createUrl('/space/',array('uid'=>$subcomment['uid']));?>"  class="tips">
				<img src="<?php echo User::model()->getUserFace($subcomment['uid'],'middle');?>" />
			</a>		
		</span>
	</div>
	<div style=" margin-left:50px;">
		<h3 class="tit_Critique lh20 mb5"><span class="right f12px mr5"></span>
		<?php

		if( $subcomment['uid'] == $this->mid AND 0){
			$href = "deleteComment($subcomment[id],$subcomment[appid])";
			$delete = CHtml::link('删除',array(),array('href'=>'###','onclick'=>$href));
		}
		?>
		<?php if($subcomment['status'] == 1){?><span class="ml5"><?php echo $delete;?></span><?php }?>
		<?php echo CHtml::link($subcomment['name'],array('/space','uid'=>$subcomment['uid']));?>
		<em class="cGray2"><?php echo friendlyDate('Y-m-d H:i:s',$subcomment['ctime']);?></em>
		<?php if($subcomment['quietly'] == 1){?><strong style="color:red">[悄悄话]</strong><?php }?>
		</h3>
		<p><?php echo $subcomment['comment'];?></p>
	</div>
	<div class="c"></div>
</div>
<?php endif;?>
