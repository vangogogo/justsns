<div class="FSort">
	<div class="tit">
		<?php echo CHtml::link('添加分组',array('/friend/addGroup'),array('title'=>'添加分组','class'=>'f12px fn right mr5 thickbox'))?>
		好友分组
	</div>
	<?php if(!empty($groups)){?>
	<ul id="f_group">
		<li<?php if(empty($_GET['gid'])) echo ' class="on"';?>>
			<?php echo CHtml::link('所有好友('.Friend::model()->getFriendNumber().')',array('/friend/index'));?>
		</li>
		<?php foreach($groups as $group){?>
		<li<?php if($group['id']==$_GET['gid']) echo ' class="on"';?>>
			<?php echo CHtml::link($group['name'].'('.Friend::model()->getFriendNumber('',$group['id']).')',array('/friend/index','gid'=>$group['id']));?>
		</li>
		<?php }?>
		<li id="fli_1"><a href="http://localhost/thinksns/index.php?s=/Friend/index/gid/1">未分组(0)</a></li>
		
	</ul>
	<?php }?>
	<div class="btm"></div>
</div>