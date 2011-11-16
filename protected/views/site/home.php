<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>

<script>
$(document).ready(function() { 
	
	$('.feed_item').click(function() {
		var _this = $(this);
		type = $(this).attr("type");
		var who = $('#who').val();
		
		var loading = '<div align="center" style="padding-top:50px"><img src="'+ROOT+'/images/loading_blue_big.gif"></div>';
		$("#feed_content").html(loading);



		var _url = '<?php echo $this->createUrl('site/feed');?>';
		$("#feed_content").load(_url,{type:type,user:who},function(txt){
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
<div class="content">
	<div class="user_info"><!-- 用户资料 begin  -->

		<div class="user_img">
			<span id="my_face"><img src="<?php echo $owner->getUserFace($uid,'middle');?>?<?php echo time();?>" /></span>
			<?php echo CHtml::link('更换头像',array('/info/face'),array('title'=>'更换头像','class'=>'a'));?>
		</div>

		<div class="Linfo">
			<div class="info">
				<h2 id="host_name"><?php echo $owner->getUserName($uid).' ';echo User::model()->getUserGroupIcon();?></h2>
				<h2 id="my_name" style="display:none"><?php echo $owner->getUserName()?></h2>
				<?php $this->widget('WMini');?>
			</div>
		</div>
	</div><!-- 用户资料 end  -->
	<!--用户应用-->
	<div class="system_info">
		<div style="width:23%">
			<?php $class =  $notify_num['message']>0?'cRed fB f14px':'cGray2';
				$text = '短消息<span class="'.$class.' hand">'.$notify_num["message"].'</span>条';
			?>
			<?php echo CHtml::link($text,array('notify/inbox'));?>
		</div>
		<div style="width:26%">
			<?php $class =  $notify_num['notification']>0?'cRed fB f14px':'cGray2';
				$text = '系统通知<span class="'.$class.' hand">'.$notify_num["notification"].'</span>条';
			?>
			<?php echo CHtml::link($text,array('notify/index','type'=>'system'));?>
		</div>
		<div style="width:26%">
			<?php $class =  $notify_num['friend']>0?'cRed fB f14px':'cGray2';
				$text = '好友请求<span class="'.$class.' hand">'.$notify_num["friend"].'</span>条';
			?>
			<?php echo CHtml::link($text,array('notify/index','type'=>'friend'));?>
		</div>
		<div style="width:23%">
		
			<?php $class =  $notify_num['wall']>0?'cRed fB f14px':'cGray2';
				$text = '留言板<span class="'.$class.' hand">'.$notify_num["wall"].'</span>条';
			?>
			<?php echo CHtml::link($text,array('/space','uid'=>$this->mid));?>
		</div>
	</div>
	<!--用户应用end-->
	<div class="tab-menu"><!-- 切换标签 begin  -->
		<div class="right" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ico_shezhi.gif" /> <a href="#">设置</a></div>
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
<?php include('_right.php');?>
