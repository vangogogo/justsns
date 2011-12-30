<script>
$(function(){
	/*
		discription: 发布回复框显示隐藏
	*/
	$('div.reply a.toReply').live('click',function(){
		$(this).parents('div.reply').find('.replyContent, .tips').show();
		$(this).hide();
	});

	/*
		discription: 取消回复
	*/
	$('div.reply button.cancleReply').click(function(){
		$(this).parents('div.reply').find('.replyContent, .tips').hide();
		$(this).parents('div.reply').find('a.toReply').show();
	})

	/*
		discription: 发表回复为空验证。
	*/
	$('div.reply button[type=submit]').click(function(){
		if($(this).parents('div.reply').find('.replyContent textarea').val()){
			//
		}else{
			jQuery.jGrowl('请输入留言内容！',{header:'错误',theme:'blue'});
			return false;
		}
	})

	/*
	* 这里加入一个删除函数。 url = <?php echo $this->controller->createUrl('ajax/boardDelete');?>
		post提交参数 people_pk 

	*/
})

</script>
<!-- seBoard 留言板 -->

<?php if(!empty($models)):?>
<div class="<?php echo $htmlOptions['seClassName'];?>">
  <div class="head cf">
	<h2 class="title"><?php echo $htmlOptions['headerTitle'];?>
	<?php if(!empty($more_link)):?>
	<span class="more">(<a href="<?php echo $more_link;?>" title="">更多</a>)</span>
	<?php endif;?>
	</h2>
  </div>
   <?php if(!empty($models)):?>
   <ul class="aeBody">
      <?php foreach($models as $ones): ?>
      <li class="cf">
		<div class="user">
            <?php $this->widget('WUserFace', array('uid'=>$ones['uid'])); ?>

		 <p><a href="<?php #echo YiicmsUchome::getUchomeLink($ones['user_id']);?>"><?php #echo YiicmsUchome::getUchomeRealname($ones['user_id']);?></a></p>
		 </div>
         <div class="info">
            <p class="msg">
               <span class="ico"></span>
               <?php echo $ones['board_content']?>
            </p>
			<p class="date">
<?php if($ones->isDeleteAccess()):?>
<a href="<?php echo $this->controller->createUrl('/board/Delete',array('people_pk'=>$ones->primaryKey));?>" class="a_confirm_link" data-msg="确认删除本评论吗？">删除</a>
<?php endif;?>

<?php echo YiicmsHelper::friendlyDate('Y-m-d H:i:s',strtotime($ones['ctime'])); ?>
            </p>
            <?php if( $ones['object_type'] == 'mentor'):?>
			<!-- board -->
			<?php if (!empty( $ones->board_reply)):?>
	            <div class="reply" >
	                <div class="handler">
	                    <span class="tips">导师回复</span>
	                </div>
		           <p class="replyedContent">
	                   <?php echo $ones->board_reply?>
	               </p>
	            </div>

			<?php else:?>
				<?php if($isUserReply):?>
				<form action="<?php echo $action;?>/" method="post">
				<input type="hidden" name="object_type" value="<?php echo $ones['object_type'];?>"/>
				<input type="hidden" name="object_id" value="<?php echo $ones['object_id'];?>"/>
				<input type="hidden" name="people_pk" value="<?php echo $ones->primaryKey;?>"/>
	            <div class="reply" >
	                <div class="handler">
	                    <a class="toReply" href="javascript:void(0)">回复留言</a>
	                    <span class="tips hidden">回复中</span>
	                </div>
	                <div class="replyContent hidden">
	                   <textarea name="board_reply"></textarea>
	                   <p>
	                      <button  type="submit" class="btn orange _tips">发布回复</button>
	                      <button  type="button" class="btn gray cancleReply">取消回复</button>
	                   </p>
	                   <?php /*
	                   <p class="hidden">
	                      [<a href="#">编辑回复</a>]
	                   </p>
	                   */?>
	                </div>
	            </div>
				</form>
				<?php endif;?>
			<?php endif;?>
			<!-- /board -->
			<?php endif;?>
         </div>
      </li>
      <?php endforeach; ?>
   </ul>
   <?php endif;?>
</div>
<?php endif;?>
<!-- /seBoard 留言板 -->
<?php if(empty($this->limit)):?>
<div class="pageList"><?php $this->widget('CLinkPager',array('pages'=>$pages)); ?></div>
<?php endif;?>
