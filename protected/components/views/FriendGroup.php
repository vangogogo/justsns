<div class="FSort">
	<div class="tit">
		<?php if($url == 'friend') echo CHtml::link('添加分组',array("/friend/addGroup"),array('title'=>'添加分组','class'=>'f12px fn right mr5 thickbox'))?>
		好友分组
	</div>
	<?php if(!empty($groups)){?>
	<ul id="f_group">
		<li<?php if(empty($_GET['gid'])) echo ' class="on"';?>>
			<?php echo CHtml::link('所有好友('.Friend::model()->getFriendNumber().')',array("/$this->url/index"));?>
		</li>
		<?php foreach($groups as $group){?>
		<li<?php if($group['id']==$_GET['gid']) echo ' class="on"';?>>
			<?php echo CHtml::link($group['name'].'('.Friend::model()->getFriendNumber('',$group['id']).')',array("/$url/index",'gid'=>$group['id']));?>
			<?php if($group['uid'] != 0 AND $this->url == 'friend') echo CHtml::link('删除',array("/$this->url/delGroup",'gid'=>$group['id']),array('class'=>'thickbox'));?>
		</li>
		<?php }?>
	</ul>
	<?php }?>
	<div class="btm"></div>
</div>