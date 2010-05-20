<div>
<div class="RC" id = "RC{$id}">

<?php if(!empty($first)){ ?>
	<div class="RLI btmline" id="first{$id}" >
		<div class="user_img">
			<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$first['uid']));?>"  class="tips">
				<img src="<?php echo User::model()->getUserFace($first['uid'],'middle');?>" />
			</a>
		</div>			
		<div class="RLC">
			<h4>
				<span class="right mt5">
				<?php
				  if( $uid == $first['uid'] || $mid == $uid){
				  echo "<a id= \"d-first".$first['appid']."\" style=\"display:none;\" class=\"del\" title=\"删除\" href=\"javascript:deleteComment( ".$first['id'].",".$first['appid'].",\'first\',".$mid.")\">删除</a>";
				  }
			 	?>
			  	</span>
				<span class="left">
					<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$first['uid']));?>">
						<strong><?php echo $first['name'];?></strong>
					</a>
					<span class="time"><?php echo date('Y-m-d H:s',$first['ctime'])?></span>
				</span>
			</h4>
			<p><?php echo $first['comment'];?><a href="javascript:replay(<?php $first['uid']?>,<?php echo $id;?>)" onclick="">回复</a></p>
		</div>
		<div class="c" ></div>
	</div>
<?php }?>

<?php if( $count > 2 ){?>
 <div class="RLI btmline" id ="showMore<?php echo $id;?>"><a href="###" onclick="showMore('{$first['appid']}',{$mid})">显示全部{$count}条</a></div>
<?php }?>

<?php if(!empty($last)){?>
	<div class="RLI btmline" id="last<?php echo $id;?>" >
		<div class="user_img">
			<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$last['uid']));?>"  class="tips">
				<img src="<?php echo User::model()->getUserFace($last['uid'],'middle');?>" />
			</a>
		</div>
		<div class="RLC">
			<h4>
				<span class="right mt5">
				<?php
				  if( $uid == $last['uid'] || $mid == $uid){
				  echo "<a id= \"d-last".$last['appid']."\" style=\"display:none;\" class=\"del\" title=\"删除\" href=\"javascript:deleteComment( ".$last['id'].",".$last['appid'].",\'first\',".$mid.")\">删除</a>";
				  }
			 	?>
			  	</span>
				<span class="left">
					<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$last['uid']));?>">
						<strong><?php echo $last['name'];?></strong>
					</a>
					<span class="time"><?php echo date('Y-m-d H:s',$last['ctime'])?></span>
				</span>
			</h4>
			<p><?php echo $last['comment'];?><a href="javascript:replay(<?php $last['uid']?>,<?php echo $id;?>)" onclick="">回复</a></p>
		</div>
		<div class="c" ></div>
	</div>			  
<?php }?>
</div>
</div>

<div class="Input_box" id="RLI<?php echo $id;?>" >
	<div class="pic" style="display:none;" id="image<?php echo $id;?>">
		<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$uid));?>"  class="tips">
			<img src="<?php echo User::model()->getUserFace($uid,'middle');?>" />
		</a>
	</div>
	<div class="box">
		<textarea id="input<?php echo $id;?>" name="comment" rows="3"  style="height:25px; width:368px;line-height:25px; <eq name='first' value = ''>display:none;</eq>" class="cGray2 inputReplay" >添加回复</textarea>
		<input id = "button<?php echo $id;?>" <?php if( $count<=2 ){echo "showmore=false";}else{echo "showmore=true";}?> type="button" class="btn_b" onclick="replayComment(<?php echo $id;?>,true,{$mid})" style="display:none;" value="回 复" />
		<input type="button" id="button2<?php echo $id;?>" name="replayHide($( '#button<?php echo $id;?>' ))" style="display:none;" value="取消">
		<input id="uid" type="hidden" value="1" >
 	</div>
 </div>
