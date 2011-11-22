	<script>
	$(function(){
		//加入收藏
		$('a.btn-fav').click(function(){
            var self = $(this),  
            hasFav = self.hasClass('fav-delete') ? 1 : 0;

            params = {
                op: paras = hasFav ? 'delete' : 'add',
                object_id: self.data('oid'),
                object_type: self.data('otype'),
            };
            $.post(
                'http://www.yiisns.com/ajax/UserCollect',params, 
                function (o) {
                    self.removeClass('stat-processing');
                    if (hasFav) { 
                        self.removeClass('fav-delete').addClass('fav-add').attr('title', '标为喜欢?').data('title', '标为喜欢?');
                    } else {
                        self.removeClass('fav-add').addClass('fav-delete').attr('title', '取消喜欢?').data('title', '取消喜欢?');
                    }
                }, 'json'
            );
		});

	});

	</script>
	
	<span id="people_Contact_<?php echo $object_type?>_<?php echo $object_id?>">
        <a class="btn-fav <?php echo empty($isCollect)?'fav-add':'fav-delete';?>" title="标为喜欢?" href="#collect-do" data-oid="<?php echo $object_id?>" data-otype="<?php echo $object_type?>"><?php echo empty($isCollect)?'收藏':'收藏';?></a>
	</span>


