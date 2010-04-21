<?php
	include('_top.php');
?>
<div class="Friend">
	<div class="sidebar mt10">

	</div>
	<div class="FList"><!-- 好友心情 begin  -->
		<?php
			//加载心情列表
			$this->renderPartial('list',array('mini_list'=>$mini_list,'pages'=>$pages));
		?>	
	</div><!-- 好友心情 end  -->
</div>