<?php
	include('_top.php');
?>
<div class="Friend">
	<div class="sidebar mt10">
		<?php if(!Yii::app()->user->isGuest) $this->widget('WFriendGroup',array('url'=>'mini/'.$this->action->id)); ?><!-- 好友分组 -->
	</div>
	<div class="FList"><!-- 好友心情 begin  -->
		<?php
			//加载心情列表
			$this->renderPartial('list',array('mini_list'=>$mini_list,'pages'=>$pages));
		?>	
	</div><!-- 好友心情 end  -->
</div>