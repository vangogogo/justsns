<p>
<img src='<?php echo $weibo_img;?>' alt='' title='' />

<?php if(Yii::app()->user->hasFlash('sendWeibo')): ?>
<div class="alert-message block-message info">
<?php echo Yii::app()->user->getFlash('sendWeibo'); ?>
</div>
<?php else: ?>
<div class="actions">

<?php echo CHtml::link('>>转发微博',array('/user/weibo/atme','sendWeibo'=>true),array('class'=>'btn danger large'));?>
</div>
<?php endif;?>
</p>
<table class="bordered-table zebra-striped mytable">
    <caption>最爱@你的人，无责任统计:<span class="random_text"><?php echo $message?></span></caption>

    <tr>
        <th class="nobg" width="80">性别</th><th width="80">男</th>        <th width="80">女</th>

    </tr>

    <tr>
        <th class="spec">人数</th><td><?php echo $sex_count['m'];?></td>       <td><?php echo $sex_count['f'];?></td> 

    </tr>
    <tr class="alt">
        <th class="spec">微薄数</th><td><?php echo $weibo_count['m'];?></td>       <td><?php echo $weibo_count['f'];?></td> 

    </tr>

    <tr>
        <th class="spec" colspan="5"><span class="goodMessage">
        悄悄和你说啊：<span class="random_text"><?php echo $random_text;?></span>.记得不要告诉其他人
        </span> </th>
    </tr>


</table>

    <?php if(!empty($user_count_list)):?>
	<ul class="media-grid ">
		<?php foreach($user_count_list as $uid => $count){ $user = $user_list[$uid];$name=$user['name']; ?>
            <li class="" id="fri_<?php echo $uid?>" >
                <div class="row">
	                <div class="span2">&nbsp

    <?
                echo '<span class="thumbnail"><a href="'.$url.'">';
                echo "<img src='{$user['profile_image_url']}' alt='{$user['name']}' title='{$user['name']}' />";
                echo '</a></span>';
    ?>

	                </div>
	                <div class="span7">
		                <p class="lh20">
			                <?php echo CHtml::encode($name,array('/space/','uid'=>$uid),array('id'=>'fname_'.$uid));?>
<br/>
                            <span class="label2 ">心情：</span><?php echo $user['description'];?>
                        </p>
	                </div>
	                <div class="span1">
		                <p class="cGray2 lh20"> @你： <span class="atcount"><?php echo $count?></span></p>
	                </div>
	            </div>
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


