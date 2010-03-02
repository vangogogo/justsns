<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>
<?php include('right.php');?>
<script>
$(document).ready(function() { 
	
	$('.feed_item').click(function() {
		var _this = $(this);
		type = $(this).attr("type");
		var who = $('#who').val();
		
		var loading = '<div align="center" style="padding-top:50px"><img src="'+ROOT+'/images/loading_blue_big.gif"></div>';
		$("#feed_content").html(loading);



		
		$("#feed_content").load(APP+"site/feed",{type:type,user:who},function(txt){
			$('.feed_item').removeClass("on");
			_this.addClass("on");
			
			if(!txt){
				$("#feed_more").hide();
				$("#feed_content").html("<div style='font-size:20px;padding-top:20px' align='center'>暂无相关动态...</div>");
			}
		});

	});

}); 

</script>
<div class="cc">
	<div class="user_info"><!-- 用户资料 begin  -->

		<div class="user_img">
			<span id="my_face"><img src="<?php echo $owner->getUserFace($uid,'middle');?>?<?php echo time();?>" /></span>
			<?php echo CHtml::link('更换头像',array('/info/face'),array('title'=>'更换头像','class'=>'a'));?>
		</div>

		<div class="Linfo">
			<div class="info">
				<h2 id="host_name"><?php echo $owner->getUserName($uid).' ';echo user::model()->getUserGroupIcon();?></h2>
				<h2 id="my_name" style="display:none"><?php echo $owner->getUserName()?></h2>
				<?php $this->widget('WMini');?>
			</div>
		</div>
	</div><!-- 用户资料 end  -->
	<!--用户应用-->
	<div class="system_info">
		<div style="width:23%">
			<a href="__APP__/Notify/inbox">短消息<span class="<?php if($notify_num['message']){ echo 'cRed fB f14px'; }else{ echo 'cGray2'; } ?> hand"><?php echo $notify_num["message"];?></span>条
			</a>
		</div>
		<div style="width:26%">
			<a href="__APP__/Notify/index/t/sys">系统通知<span class="<?php if($notify_num['notification']){ echo 'cRed fB f14px'; }else{ echo 'cGray2'; } ?> hand"><?php echo $notify_num["notification"];?></span>条 </a>
		</div>
		<div style="width:26%"><a href="__APP__/Notify/index/t/fri" >好友请求<span class="<?php if($notify_num['friend']){ echo 'cRed fB f14px'; }else{ echo 'cGray2'; } ?> hand"><?php echo $notify_num["friend"];?></span>条
			</a>
		</div>
		<div style="width:23%"><a href="__APP__/space/{$mid}#wall">留言板<span class="<?php if($notify_num['wall']){ echo 'cRed fB f14px'; }else{ echo 'cGray2'; } ?> hand"><?php echo $notify_num["wall"];?></span>条</a>
		</div>
	</div>
	<!--用户应用end-->
	<div class="tab-menu"><!-- 切换标签 begin  -->
		<div class="right" style="display:none;"><img src="../Public/images/ico_shezhi.gif" /> <a href="#">设置</a></div>
		<ul>
			<li class="feed_item on" type="0"><a href="javascript:void(0)" id="feed_all_item"><span>全部动态</span></a></li>
			<?php foreach($apps as $app){?>
			<li class="feed_item" type="<?php echo $app['id']?>"><a href="javascript:void(0)" rel="<?php echo $app['id']?>"><span><?php echo $app['name'];?></span></a></li>
			<?php }?>
		</ul>
	</div><!-- 切换标签 end  -->
	<div class="Friend" ><!-- 好友心情 begin  -->

		<div class="FList" id="feed_content">


		</div>		
		<div class="alR lh35">
			<a href="###" id='getMoreFeed' class="U">点击查看更多...</a>
		</div>
	</div><!-- 好友心情 end  -->

</div>
<div class="c"></div>