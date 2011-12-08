<!-- top_bar -->
<?php
		$array = array('adobe.com','default','flickr.com','lwis.celebrity','mtv.com','nvidia.com','vimeo.com');
      $this->widget('ext.bootstrap.widgets.BootTopbar',array(
        #'themeCssFile' => $array[6].'/default.css',
        'homeUrl'=>'/',
        'container_class'=>'container-fluid',
        'search'=>'',
        'items'=>array(
            array('label'=>'前台', 'url'=>'/'),
            array('label'=>'站内应用', 'url'=>array('/app'), 'items'=>array(
                array('label'=>'星座', 'url'=>array('/astro')),
				array('label'=>'个人空间', 'url'=>array('/space/mine'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'好友', 'url'=>array('/friend/index'),'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array('class'=>'ico_arrow')),
				array('label'=>'小组', 'url'=>array('/group'),'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'谁最@我', 'url'=>array('/user/weibo')),
            )),
            array('label'=>'社区资源', 'url'=>'http://www.yiiframework.com/doc/guide/1.1/zh_cn/index','linkOptions'=>array('target'=>'_blank'), 'items'=>array(
				array('label'=>'Yii官方文档', 'url'=>'http://www.yiiframework.com/doc/guide/1.1/zh_cn/index','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Yii官方扩展', 'url'=>'http://www.yiiframework.com/extensions','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Yii Book', 'url'=>'http://yiibook.com/','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Yii Demo', 'url'=>'http://yiidemo.sinaapp.com/','linkOptions'=>array('target'=>'_blank')),
            )),
            array('label'=>'我的博客', 'url'=>'http://blog.lockphp.com','linkOptions'=>array('target'=>'_blank')),
            array('label'=>'清空缓存', 'url'=>array('/site/FlushCache')),
        ),
		'items2'=>Yii::app()->user->isGuest?array():
		array(
			array('label'=>'短信箱', 'url'=>array('/notify'),'visible'=>Yii::app()->user->isGuest),
			array('label'=>Yii::app()->user->name, 'url'=>array('/user'),'visible'=>Yii::app()->user->isGuest),
			array('label'=>'帐号', 'url'=>array('/user/logout'), 'items'=>array(
				array('label'=>'我的微博', 'url'=>array('/user/weibo')),
                array('label'=>'退出', 'url'=>array('/user/logout')),				
            )),
		)		
		,
    )); 
?>
<!-- /top_bar -->
