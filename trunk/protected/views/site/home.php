<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>

<script>
$(document).ready(function() { 
	
	$('.feed_item').click(function() {
		var _this = $(this);
		type = $(this).attr("type");
		var who = $('#who').val();
		var loading = '<div align="center" style="padding-top:50px"><img src="'+ROOT+'/images/loading_blue_big.gif"></div>';
		$("#feed_content").html(loading);

		var _url = '<?php echo $this->createUrl('site/feed');?>';
		$("#feed_content").load(_url,{type:type,user:who},function(txt){
			$('.feed_item').removeClass("on");
			_this.addClass("on");
			
			if(!txt){
				$("#feed_more").hide();
				$("#feed_content").html("<div style='font-size:20px;padding-top:20px' align='center'>暂无相关动态...</div>");
			}
		});
	});

}); 

</script>
<div class="page-header">
	<h1>我的动态</h1>
</div>
<div class="content">
	<!-- 用户资料 begin  -->
	<div class="row">
		<?php $this->widget('WMini');?>
	</div>
	<!-- 用户资料 end  -->

	<!-- 广播 begin  -->
	<div class="Friend" >
		<div class="FList" id="feed_content">
		<?php
			//加载心情列表
			#$this->renderPartial('list',array('mini_list'=>$models,'pages'=>$pages));
		?>	
		</div>
	</div>
	<!-- 广播 end  -->
	
</div>
<?php include('_right.php');?>
