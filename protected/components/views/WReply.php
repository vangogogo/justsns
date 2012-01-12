<div class="row">
	<div class="RC" id = "RC<?php echo $id;?>">
	<?php if(!empty($first)){ ?>
		<div class="RLI btmline" id="first<?php echo $id;?>" >
			<div class="user_img">
                <?php $this->Widget('WUserFace',array('uid'=>$first['uid']));?>
			</div>
			<div class="RLC">
				<h4>
					<span class="right mt5">
					<?php
						if( $uid == $first['uid'] || $mid == $uid){
						echo "<a id= \"d-first".$first['object_id']."\" style=\"display:none;\" class=\"del\" title=\"删除\" href=\"javascript:deleteComment( ".$first['id'].",".$first['object_id'].",'first',".$mid.")\">删除</a>";
						}
					?>
					</span>
					<span class="left">
						<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$first['uid']));?>">
							<strong class="name<?php echo $first['uid'];?>"><?php echo $first['name'];?></strong>
						</a>
						<span class="time"><?php echo YiicmsHelper::friendlyDate('Y-m-d H:s',$first['ctime'])?></span>
					</span>
				</h4>
				<p><?php echo $first['comment'];?> <a href="javascript:reply(<?php echo $first['uid']?>,<?php echo $id;?>)" onclick="">回复</a></p>
			</div>
			<div class="clear" ></div>
		</div>
	<?php }?>
	
	<?php if( $count > 2 ):?>
	 <div class="RLI btmline2" id ="showMore<?php echo $id;?>"><a href="###" onclick="showMore(<?php echo $first['object_id'];?>,<?php echo $mid;?>)">显示全部<?php echo $count?>条</a></div>
	<?php endif;?>
	
	<?php if(!empty($last)){?>
		<div class="RLI btmline" id="last<?php echo $id;?>" >
			<div class="user_img">
                <?php $this->Widget('WUserFace',array('uid'=>$last['uid']));?>
			</div>
			<div class="RLC">
				<h4>
					<span class="right mt5">
					<?php
						if( $uid == $last['uid'] || $mid == $uid){
							echo "<a id= \"d-last".$last['object_id']."\" style=\"display:none;\" class=\"del\" title=\"删除\" href=\"javascript:deleteComment( ".$last['id'].",".$last['object_id'].",'last',".$mid.")\">删除</a>";
						}
					?>
					</span>
					<span class="left">
						<a href="<?php echo Yii::app()->createUrl('/space/',array('uid'=>$last['uid']));?>">
							<strong class="name<?php echo $last['uid'];?>"><?php echo $last['name'];?></strong>
						</a>
						<span class="time"><?php echo YiicmsHelper::friendlyDate('Y-m-d H:s',$last['ctime'])?></span>
					</span>
				</h4>
				<p><?php echo $last['comment'];?> <a href="javascript:reply(<?php echo $last['uid']?>,<?php echo $id;?>)" onclick="">回复</a></p>
			</div>
			<div class="c" ></div>
		</div>
	<?php }?>
	</div>
</div>

<div class="row Input_box" id="RLI<?php echo $id;?>" >
	<div class="pic" style="display:none;float:left;width:80px;" id="image<?php echo $id;?>">
         <?php $this->Widget('WUserFace',array('uid'=>$mid));?>
	</div>
	<div class="box">
		<textarea id="input<?php echo $id;?>" name="comment" rows="3"  style="height:25px; width:368px;line-height:25px; <?php if(empty($first)):?>display:none;<?php endif;?>" class="t_input t_area inputReply" >添加回复</textarea>
		<input id = "button<?php echo $id;?>" <?php if( $count<=2 ){echo "showmore=false";}else{echo "showmore=true";}?> type="button" class="btn btn_b" onclick="replyComment(<?php echo $id;?>,true,<?php echo $mid;?>)" style="display:none;" value="回 复" />
		<input type="button" id="button2<?php echo $id;?>" name="replyHide($('#button<?php echo $id;?>'))" style="display:none;" value="取消">
		<input id="uid" type="hidden" value="1" >
 	</div>
 </div>
