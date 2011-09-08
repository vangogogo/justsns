<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>
<style>
.system_info div { text-align:center;}
</style>
	<div class="user_info"><!-- 用户资料 begin  -->

		<div class="user_img">

			<span id="my_face"><img src="<?php echo str_replace('/50/','/180/',$sina_info['profile_image_url']);?>" alt='' title='' /></span>
			<?php #echo CHtml::link('更换头像',array('/info/face'),array('title'=>'更换头像','class'=>'a'));?>
		</div>

		<div class="Linfo">
			<div class="info">
				<h2 id="host_name"><?php echo $sina_info['name'];?></h2>
				<h2 id="my_name" style="display:none"></h2>
                <p><?php echo $sina_info['location'];?></p>
                <p><?php echo $sina_info['description'];?></p>
			</div>
		</div>
	</div><!-- 用户资料 end  -->
	<!--用户应用-->
	<div class="system_info">
		<div style="width:33%">
			<?php $class =  $sina_info['followers_count']>0?'cRed fB f14px':'cGray2';
				$text = '粉丝<span class="'.$class.' hand">'.$sina_info["followers_count"].'</span>';
			?>
			<?php echo CHtml::link($text,array('#','type'=>'system'));?>
		</div>
		<div style="width:33%">
			<?php $class =  $sina_info['friends_count']>0?'cRed fB f14px':'cGray2';
				$text = '关注<span class="'.$class.' hand">'.$sina_info["friends_count"].'</span>';
			?>
			<?php echo CHtml::link($text,array('#','type'=>'friend'));?>
		</div>
		<div style="width:33%">
		
			<?php $class =  $sina_info['statuses_count']>0?'cRed fB f14px':'cGray2';
				$text = '微薄<span class="'.$class.' hand">'.$sina_info["statuses_count"].'</span>';
			?>
			<?php echo CHtml::link($text,array('#','uid'=>$this->mid));?>
		</div>

	</div>
	<!--用户应用end-->
	<div class="tab-menu"><!-- 切换标签 begin  -->
		<div class="right" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ico_shezhi.gif" /> <a href="#">设置</a></div>
		<ul>
			<li class="feed_item on" type="0"><a href="javascript:void(0)" id="feed_all_item"><span>全部动态</span></a></li>
            <?php if(!empty($apps)):?>
			<?php foreach($apps as $app){?>
			<li class="feed_item" type="<?php echo $app['id']?>"><a href="javascript:void(0)" rel="<?php echo $app['id']?>"><span><?php echo $app['name'];?></span></a></li>
			<?php }?>
            <?php endif;?>
		</ul>
	</div><!-- 切换标签 end  -->
	<div class="Friend" ><!-- 好友心情 begin  -->

		<div class="FList" id="feed_content">


		</div>		
		<div class="alR lh35">
			<a href="###" id='getMoreFeed' class="U">点击查看更多...</a>
		</div>
	</div><!-- 好友心情 end  -->

    <?php if(!empty($user_count_list)):?>
	<ul class="user-list">
		<?php foreach($user_count_list as $uid => $count){ $user = $user_list[$uid];$name=$user['name']; ?>
            <li class="info" id="fri_<?php echo $friend['id']?>" >
	            <div class="left" style="width:70px;">

<?
            echo '<span class="headpic50"><a href="'.$url.'">';
            echo "<img src='{$user['profile_image_url']}' alt='{$user['name']}' title='{$user['name']}' />";
            echo '</a></span>';
?>

	            </div>
	            <div class="left" style="width:400px; margin-right:30px;">
		            <p class="lh20">
			            <?php echo CHtml::link($name,array('/space/','uid'=>$uid),array('id'=>'fname_'.$uid));?>
		            </p>


                    <p>
                        <span class="wn">心情：</span><?php echo $user['description'];?>
                    </p>
	            </div>
	            <div class="left" style="width:100px;">
		            <p class="cGray2 lh20"> @你： <span class="atcount"><?php echo $count?></span>


		            </p>
	            </div>
	            <div class="clear"></div>
            </li>
		<?php }?>
	</ul>

    <?php endif;?>
<style>
.atcount{
    font-size:30px;
    color:#E88400;
}
</style>


