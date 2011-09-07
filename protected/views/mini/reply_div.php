<?php if(!empty($comments)):?>
<?php foreach($comments as $vo):?>
<div class="RLI btmline" id="RLI<?php echo $vo['id'];?>" >
	<div class="user_img">
        <?php $this->Widget('WUserFace',array('uid'=>$vo['uid']));?>
	</div>
	<div class="RLC">
		<h4>
			<span class="right mt5">
			<?php
				if( $uid == $vo['uid'] || $mid == $uid){
				echo "<a id= \"d-RLI".$vo['id']."\" style=\"display:none;\" class=\"del\" title=\"删除\" href=\"javascript:deleteComment( ".$vo['id'].",".$vo['appid'].")\">删除</a>";
				}
			?>
			</span>
			<span class="left">
				<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$vo['uid']));?>">
					<strong class="name<?php echo $vo['uid'];?>"><?php echo $vo['name'];?></strong>
				</a>
				<span class="time"><?php echo date('Y-m-d H:s',$vo['ctime'])?></span>
			</span>
		</h4>
		<p><?php echo $vo['comment'];?><a href="javascript:reply(<?php echo $vo['uid']?>,<?php echo $vo['appid'];?>)" onclick="">回复</a></p>
	</div>
	<div class="c" ></div>
</div>
<?php endforeach;?>
<?php endif;?>
