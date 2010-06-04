<?php if(!empty($comments)):?>
	<?php foreach($comments as $vo):?>
	<li id="comm<?php echo $vo['id'];?>"class="comlist">
  		<div class="left" style="width:65px;">
  			<span class="headpic50">
  				<a href="__APP__/space/{$vo['uid']}" class="tips" rel="__TS__/Index/userInfo/uid/{$vo['uid']}">
  					<img src="<?php echo User::model()->getUserFace($vo['uid']);?>"/>
  				</a>
  			</span>
  		</div>
		<div style="margin-left:65px;">
			<div style="padding-bottom:20px;">
				<h3 class="tit_Critique lh25 mb5">
					<span class="right f12px mr5">
					<?php
					$href = "javascript:replay($vo[name],$vo[id])";
					$string = CHtml::link('回复','javascript:void(0)',array('class'=>'comment_reply','reply_id'=>$vo[id],'reply_name'=>$vo[name]));

					if( $vo['uid'] == $this->mid){
						$delete = CHtml::link('删除','javascript:void(0)',array('class'=>'doDeleteComment','id'=>$vo[id],'appid'=>$vo[appid]));
					}
					?>
					<span><?php echo $string?></span>
					<?php if(!empty($delete)){?><span class="ml5"><?php echo $delete;?></span><?php }?>
					
					</span>
					<?php echo CHtml::link($vo['name'],array('/space','uid'=>$vo['uid']));?>

					<em class="cGray2"><?php echo friendlyDate('Y-m-d H:i:s',$vo['ctime']);?></em>
					<?php if($vo['quietly'] == 1){?><font color="red"><b>[悄悄话]</b></font><?php }?>
				</h3>
				
				<p><?php echo $vo['comment'];?></p>
			</div>
			<div class="subcomment">
	
	
				<?php if(!empty($vo['subcomment'])): ?>
					<?php foreach($vo['subcomment'] as $vo):?>
						<div class="sublist pt5 clear" id="comm<?php echo $vo['id'];?>">
							<div class="left" style="width:50px;">
								<span class="pic38"><a href="__APP__/space/<?php echo $vo['id'];?>" class="tips" rel="__TS__/Index/userInfo/uid/{$value['uid']}">
									<img src="<?php echo User::model()->getUserFace($vo['uid']);?>"/>
								</a></span>
							</div>
							<div style=" margin-left:50px;">
								<h3 class="tit_Critique lh20 mb5"><span class="right f12px mr5">         
								<?php
			
								if( $vo['uid'] == $this->mid AND 0){
									$href = "deleteComment($vo[id],$vo[appid])";
									$delete = CHtml::link('删除',array(),array('href'=>'###','onclick'=>$href));
								}
								?>
								<?php if($vo['status'] == 1){?><span class="ml5"><?php echo $delete;?></span><?php }?>
								<?php echo CHtml::link($vo['name'],array('/space','uid'=>$vo['uid']));?>
								<em class="cGray2"><?php echo friendlyDate('Y-m-d H:i:s',$vo['ctime']);?></em>
								<?php if($vo['quietly'] == 1){?><font color="red"><b>[悄悄话]</b></font><?php }?>					
								</h3>
								<p><?php echo $vo['comment'];?></p>
							</div>
							<div class="c"></div>
						</div>
			                    
					<?php endforeach;?>
				<?php endif;?>			
			
			</div>
			<div class="c"></div>
		</div>	
	</li>
	<?php endforeach;?>

<?php endif;?>