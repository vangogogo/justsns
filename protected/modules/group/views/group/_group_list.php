<div class="grouplist" <?php echo "class=''"?>>
	<ul>
		<?php foreach($group_list as $group): $url = Yii::app()->createUrl('/group/group/show',array('gid'=>$group['id']));?>
		<li>

<div class="ul" style="margin-bottom:6px;"></div>
<div class="clist2">
<a href="<?php echo $url?>"><img src="<?php echo $group->getGroupLogo();?>" align="left" style="margin:0 20px 0 10px;" alt="<?php echo $group['name'];?>"></a><div class="pl" style="float:right;">创建于<?php echo YiicmsHelper::friendlyDate('Y-m-d',$group['ctime'])?> <a href="<?php echo $url?>"><?php echo CHtml::encode($group['threadcount'])?>人</a></div><span class="pl2"><a href="<?php echo $url?>"><?php echo $group['name'];?></a></span> <br>
        <div class="pl"><?php echo $group['intro'];?> ...</div></div>

		</li>
		<?php endforeach;?>
	</ul>
</div>


