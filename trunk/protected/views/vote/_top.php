<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/poll.css');?>
<div class=page_title> <!-- page_title begin -->
	<div class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app04.gif" class="img" />投票</div>
	<div class="c"></div>
</div><!-- page_title end -->
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
				array('label'=>'<span>好友的投票</span>', 'url'=>array('/vote/index')),
				array('label'=>'<span>我的投票</span>', 'url'=>array('/vote/my')),
				array('label'=>'<span>大家的投票</span>', 'url'=>array('/vote/all')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>发起投票</span>', 'url'=>array('/vote/create')),
			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的心情</span>', 'url'=>array('/friend/index','uid'=>$uid)),
			);
		}

		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>