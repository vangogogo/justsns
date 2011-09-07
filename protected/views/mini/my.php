<?php
	include('_top.php');
?>
<div class="grid_15 suffix_1">
	<div class="FList">
		<?php
			//加载心情列表
			$this->renderPartial('list',array('mini_list'=>$mini_list,'pages'=>$pages));
		?>	
	</div>
	<!-- 好友心情 end  -->
</div>
<div class="grid_8">
	<?php if(!Yii::app()->user->isGuest) $this->widget('WFileAway',array('url'=>'mini/'.$this->action->id)); ?><!-- 好友分组 -->
</div>

