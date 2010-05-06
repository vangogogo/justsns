<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/group.css');?>

<div class=page_title> <!-- page_title begin -->
	<h2 class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app05.gif" class="img" /><?php echo Yii::t('sns', 'group');?></h2>
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
				array('label'=>'<span>我的群组</span>', 'url'=>array('/group/default/friend','id'=>$gid)),
				array('label'=>'<span>好友的群组</span>', 'url'=>array('/group/default/topic','id'=>$gid)),
				array('label'=>'<span>全部群组</span>', 'url'=>array('/group/default/all')),
				array('label'=>'<span>最新话题</span>', 'url'=>array('/group/default/top')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>发表话题</span>', 'url'=>array('/group/topic/create')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>创建新群</span>', 'url'=>array('/group/default/create')),

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