<?php
	include('_top.php');
?>
<div class="content">
	<!-- 心情 begin  -->
	<div class="FList">
		<?php
			//加载心情列表
			$this->renderPartial('list',array('mini_list'=>$models,'pages'=>$pages));
		?>	
	</div>
	<!-- 心情 end  -->
</div>
<div class="sidebar">
	<?php #if(!Yii::app()->user->isGuest) $this->widget('WFileAway',array('url'=>'mini/'.$this->action->id)); ?><!-- 好友分组 -->
</div>
