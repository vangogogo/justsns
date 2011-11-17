<!-- top_bar -->
<?php
		$array = array('adobe.com','default','flickr.com','lwis.celebrity','mtv.com','nvidia.com','vimeo.com');
      $this->widget('ext.bootstrap.widgets.BootTopbar',array(
        #'themeCssFile' => $array[6].'/default.css',
        'items'=>array(
            array('label'=>'首页', 'url'=>array('/site')),
            array('label'=>'星座', 'url'=>array('/astro'), 'items'=>array(
				array('label'=>'个人空间', 'url'=>array('/space/mine'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'好友', 'url'=>array('/friend/index'),'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array('class'=>'ico_arrow')),
				array('label'=>'小组', 'url'=>array('/group'),'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'谁最@我', 'url'=>array('/user/weibo')),
            )),
            array('label'=>'Yii官方文档', 'url'=>'http://www.yiiframework.com/doc/guide/1.1/zh_cn/index','linkOptions'=>array('target'=>'_blank'), 'items'=>array(
                array('label'=>'Yii官方扩展', 'url'=>'http://www.yiiframework.com/extensions','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Yii Book', 'url'=>'http://yiibook.com/','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Yii Demo', 'url'=>'http://yiidemo.sinaapp.com/','linkOptions'=>array('target'=>'_blank')),
            )),
            array('label'=>'联系我们', 'url'=>array('/site/contact')),
        ),
		'items2'=>Yii::app()->user->isGuest?array(
			array('label'=>'登录', 'url'=>Yii::app()->user->loginUrl,'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'注册', 'url'=>array('/user/registration'),'visible'=>!Yii::app()->user->isGuest),
		):
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
