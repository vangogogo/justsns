<!-- page_title begin -->
<div class=page_title> 
	<h2><img src="<?php echo Yii::app()->theme->baseUrl;?>images/applications.gif" />帐号管理</h2>
	<div class="c"></div>
</div><!-- page_title end -->
<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php $this->widget('ext.bootstrap.widgets.menu.BootTabs',array(
		'items'=>array(
			array('label'=>'<span>基本资料</span>', 'url'=>array('/info/index')),
			array('label'=>'<span>个人情况</span>', 'url'=>array('/info/intro')),
			array('label'=>'<span>联系方式</span>', 'url'=>array('/info/contact')),
			array('label'=>'<span>教育情况</span>', 'url'=>array('/info/education')),
			array('label'=>'<span>工作情况</span>', 'url'=>array('/info/career')),
			array('label'=>'<span>上传头像</span>', 'url'=>array('/info/face')),
		),
		'encodeLabel'=>false,
	)); ?>
</div>
<!-- 切换标签 end  -->