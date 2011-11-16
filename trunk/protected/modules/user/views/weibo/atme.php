<img src='<?php echo $weibo_img;?>' alt='' title='' />

<?php if(Yii::app()->user->hasFlash('sendWeibo')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('sendWeibo'); ?>
</div>
<?php else: ?>

<?php echo CHtml::link('>>转发微博',array('/user/weibo/atme','sendWeibo'=>true),array('class'=>'btn'));?>
<?php endif;?>

<table class="mytable">
    <caption>最爱@你的人，无责任统计:<span class="random_text"><?php echo $message?></span></caption>
    <thead>
    <tr>
        <th class="nobg" width="80">性别</th><th width="80">男</th>        <th width="80">女</th>

    </tr>
    </thead>
    <tr>
        <th class="spec">人数</th><td><?php echo $sex_count['m'];?></td>       <td><?php echo $sex_count['f'];?></td> 

    </tr>
    <tr class="alt">
        <th class="spec">微薄数</th><td><?php echo $weibo_count['m'];?></td>       <td><?php echo $weibo_count['f'];?></td> 

    </tr>
    <tfoot>
    <tr>
        <th class="spec" colspan="5"><span class="goodMessage">
        悄悄和你说啊：<span class="random_text"><?php echo $random_text;?></span>.记得不要告诉其他人
        </span> </th>
    </tr>
    </tfoot>

</table>

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
	            <div class="left" style="width:340px; margin-right:80px;">
		            <p class="lh20">
			            <?php echo CHtml::link($name,array('/space/','uid'=>$uid),array('id'=>'fname_'.$uid));?>
		            </p>


                    <p class="wn">
                        <span class="">心情：</span><?php echo $user['description'];?>
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
.random_text{
    font-size:16px;
    color:#E88400;
}
.user-list .info p.wn {
    color:#555;
}
</style>


