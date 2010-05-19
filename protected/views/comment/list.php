<?php if(!empty($comments)):?>
	<?php foreach($comments as $vo):?>
	<li id="comm<?php echo $vo['id'];?>"class="comlist">
  		<div class="left" style="width:65px;">
  			<span class="headpic50">
  				<a href="__APP__/space/{$vo['uid']}" class="tips" rel="__TS__/Index/userInfo/uid/{$vo['uid']}"><img src="{$vo['face']}" /></a>
  			</span>
  		</div>
		<div style="margin-left:65px;">
			<div style="padding-bottom:20px;">
				<h3 class="tit_Critique lh25 mb5">
					<span class="right f12px mr5">
					<?php
					$href = "javascript:replay($vo[name],$vo[id])";
					$string = CHtml::link('回复',array(),array('href'=>$href));
					if( $vo['status'] ){
						$href = "deleteComment($vo[id],$vo[appid])";
						$string = CHtml::link('删除',array(),array('href'=>'###','onclick'=>$href));
					}
					?>
					</span>
					<span><?php echo $string?></span>
					<?php if($vo['status'] == 1){?><span class="ml5"><?php echo $delete;?></span><?php }?>
					<a href="__APP__/space/{<?php echo $vo['uid'];?>"><?php echo $vo['name'];?></a>
					<em class="cGray2"><?php echo friendlyDate('Y-m-d H:i:s',$vo['ctime']);?></em>
					<?php if($vo['quietly'] == 1){?><font color="red"><b>[悄悄话]</b></font><?php }?>
				</h3>
				
				<p><?php echo $vo['comment'];?></p>
			</div>
			<div class="c"></div>
		</div>	
	</li>
	<?php endforeach;?>
<?php endif;?>