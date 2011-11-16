<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'Yiis',
	
	'logoutUrl'=>'/site/logout',
	// this is used in error pages
	'adminEmail'=>'huanghuibin@gmail.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2012 by lockphp.com All Rights Reserved.',

	'author'=>'huanghuibin@gmail.com',
	'homepage'=>SUB_DOMAIN,
	'keywords'=>'yii for sae,yiicms,yii程序共享,yii读写分离,yii教程,yii源码实例.',
	'description'=>'Yii is a high-performance component-based PHP framework best for Web 2.0 development.新浪SAE是云计算服务商',

	'WordPressAPIKey'=>'af6461d228d3',

	// this is used in contact page
	'adminEmail'=>'huanghuibin@gmail.com',
	'upload_dir'=>'/uploads/images/',
	'uploadPath'=>$path.'/uploads/images/',
    'site_name'=>'站点',
);

