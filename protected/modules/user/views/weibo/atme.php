
<table>
    <tr>
        <td><?php echo $sex_count['m'];?></td><td></td>
    </tr>
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
.user-list .info p.wn {
    color:#555;
}
</style>


