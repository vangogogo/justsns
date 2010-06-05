<?php if(!empty($comments)):?>
	<?php foreach($comments as $vo):
		$this->renderPartial('../comment/comment_li',array('comment'=>$vo));
	endforeach;?>
<?php endif;?>