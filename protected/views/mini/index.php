<?php
	include('_top.php');
?>
<div class="Friend">
	<div class="sidebar mt10">
		<!-- 好友分组 -->
		<?php if(!Yii::app()->user->isGuest) $this->widget('WFriendGroup',array('url'=>'mini/'.$this->action->id)); ?>
	</div>
	<!-- 好友心情 begin  -->
	<div class="FList">
		<?php
			//加载心情列表
			$this->renderPartial('list',array('mini_list'=>$mini_list,'pages'=>$pages));
		?>	
	</div>
	<!-- 好友心情 end  -->
</div>