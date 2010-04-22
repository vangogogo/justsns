<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/mood.css');?>
<div class=page_title> <!-- page_title begin -->
	<div class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app05.gif" class="img" /><?php echo Yii::t('sns', 'group');?></div>


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
				array('label'=>'<span>好友的小组</span>', 'url'=>array('/group/friend')),
				array('label'=>'<span>我的小组</span>', 'url'=>array('/group/my')),
				array('label'=>'<span>所有小组</span>', 'url'=>array('/group/all')),
				array('label'=>'<span>最新话题</span>', 'url'=>array('/group/top')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>发表话题</span>', 'url'=>array('/group/create')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>新建群组</span>', 'url'=>array('/group/create')),

			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的小组</span>', 'url'=>array('/friend/index','uid'=>$uid)),
			);
		}

		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>