<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/mood.css');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/mini.js');?>
<!-- page_title begin -->
<div class=page_title>
	<div class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app04.gif" class="img" /><?php echo Yii::t('sns', 'mini');?></div>
	<?php
		$this->widget('WMini');
	?>
	<div class="c"></div>
</div>
<!-- page_title end -->
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
				array('label'=>'<span>好友的心情</span>', 'url'=>array('/mini/index')),
				array('label'=>'<span>我的心情</span>', 'url'=>array('/mini/my')),
				array('label'=>'<span>大家的心情</span>', 'url'=>array('/mini/all')),
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