<li id="comm<?php echo $comment['id'];?>"class="comlist">
	<div class="left" style="width:65px;">
		<span class="headpic50">
			<a href="__APP__/space/{$comment['uid']}" class="tips" rel="__TS__/Index/userInfo/uid/{$comment['uid']}">
				<img src="<?php echo User::model()->getUserFace($comment['uid']);?>"/>
			</a>
		</span>
	</div>
	<div style="margin-left:65px;">
		<div style="padding-bottom:20px;">
			<h3 class="tit_Critique lh25 mb5">
				<span class="right f12px mr5">
				<?php
				$href = "javascript:reply($comment[name],$comment[id])";
				$string = CHtml::link('回复','javascript:void(0)',array('class'=>'comment_reply','reply_id'=>$comment[id],'reply_name'=>$comment[name]));

				if( $comment['uid'] == $this->mid){
					$delete = CHtml::link('删除','javascript:void(0)',array('class'=>'doDeleteComment','id'=>$comment[id],'appid'=>$comment[appid]));
				}
				?>
				<span><?php echo $string?></span>
				<?php if(!empty($delete)){?><span class="ml5"><?php echo $delete;?></span><?php }?>
				
				</span>
				<?php echo CHtml::link($comment['name'],array('/space','uid'=>$comment['uid']));?>

				<em class="cGray2"><?php echo friendlyDate('Y-m-d H:i:s',$comment['ctime']);?></em>
				<?php if($comment['quietly'] == 1){?><font color="red"><b>[悄悄话]</b></font><?php }?>
			</h3>
			
			<p><?php echo $comment['comment'];?></p>
		</div>
		<div class="subcomment">

			<?php $subcomments = $comment['subcomments'];if(count($subcomments)>0):?>
				<?php foreach($subcomments as $subcomment):?>
					<?php $this->renderPartial('../comment/subcomment_li',array('subcomment'=>$subcomment));?>
				<?php endforeach;?>
			<?php endif;?>
		
		</div>
		<div class="c"></div>
	</div>	
</li>
