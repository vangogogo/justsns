<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$uid = Yii::app()->request->getParam('uid');
		
		if(!empty($uid)) {
			$is_me = ($this->mid == $uid);
		}else {
			$uid = $this->mid;
			$is_me = true;
		}	
		
		if($is_me)
		{
			$items =array(
				array('label'=>'<span>全部</span>', 'url'=>array('/friend/index','gid'=>0)),
			);
            if(!empty($friendGroup))
            {
                foreach($friendGroup as $tmp)
                {
                    $items[]= array('label'=>'<span>'.$tmp['name'].'</span>', 'url'=>array('/friend/index','gid'=>$tmp['id']));
                }
            }
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的好友</span>', 'url'=>array('/friend/index','uid'=>$uid)),
				array('label'=>'<span>邀请好友</span>', 'url'=>array('/invite/index')),
			);
		}
		
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>

    <?php if(!empty($friends)):?>
	<ul class="user-list">
		<?php foreach($friends as $friend){?>
            <?php $this->renderPartial('_friend_list',array('friend'=>$friend,'uid'=>$uid,'is_me'=>$is_me));?>
		<?php }?>
	</ul>

	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
    <?php endif;?>

