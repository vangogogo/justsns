<?php
require('DatabaseConfig.php');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$path=dirname(dirname(dirname(__FILE__)));
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii TEST',

	'timeZone' => 'Asia/Shanghai',
	//'sourceLanguage'=>'zh_cn',
	'language'=>'zh_cn',

	'theme' => 'blue',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.jformvalidate.*', //our extension
		'application.extensions.CUplodifyWidget.*',
		'application.extensions.CDropDownMenu.*', //our extension
		'application.extensions.yiidebugtb.*', //our extension

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'db'=>DatabaseConfig::dbinfo(),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, log',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				
				array( // configuration for the toolbar
				  'class'=>'XWebDebugRouter',
				  'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
				  'levels'=>'error, warning, trace, profile, info',
				),
				*/
			),
		),
		'cache'=>array(
			'class'=>'system.caching.CFileCache',
			'directoryLevel'=>'2',
		),
		'authManager'=>array(
			// The type of Manager (Database)
			'class'=>'CDbAuthManager',
			// The database connection used
			'connectionID'=>'db',
			// The itemTable name (default:authitem)
			'itemTable'=>'auth_item',
			// The assignmentTable name (default:authassignment)
			'assignmentTable'=>'auth_assignment',
			// The itemChildTable name (default:authitemchild)
			'itemChildTable'=>'auth_item_child',
		),

				// url
		'urlManager'=>array(
			// the URL format. It must be either 'path' or 'get'.
			// path: index.php/controller/action/attribute/value
			// get: index.php?r=controller/action&attribute=value
			//'urlFormat'=>'path',
			// show www.example.com/index.php/controller/action
			// or just www.example.com/controller/action
			'showScriptName' => false,
			// rules to redirect a specific url to the controller you want
			// see: http://www.yiiframework.com/doc/guide/topics.url
			'rules'=>array(
				// www.example.com/home instead of www.example.com/site/index
				//'home'=>'site/index',
				'space/uid/<uid:\d+>'=>'space/index',
		
				'post/<pid:\d+>'=>'post/show',

				'group/topic/<tid:\d+>'=>'group/topic/view',
				'group/<gid:\d+>'=>'group/group/view',
				//'group/topic/tid/<tid:\d+>'=>'group/topic/view',
				'group/create/<gid:\d+>'=>'group/group/create',
				'group/new_topic/<gid:\d+>'=>'group/topic/create',
			),
		),
		//验证模块
		'jformvalidate' => array (
			'class' => 'application.extensions.jformvalidate.EJFValidate',
			'enable' => true
		),		
	),

	// application modules
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'yiidev',
		),
		
		'srbac' => array( 
			'userclass'=>'User', //optional defaults to User 
			'userid'=>'id', //optional defaults to userid 
			'username'=>'username', //optional defaults to username 
			'debug'=>true, //optional defaults to false 
			'pageSize'=>10, //optional defaults to 15 
			'superUser' =>'Authority', //optional defaults to Authorizer 
			'css'=>'srbac.css',  //optional defaults to srbac.css 
			'layout'=> 	'application.views.layouts.main', //optional defaults to  // application.views.layouts.main, must be an existing alias 
			'notAuthorizedView'=> 'srbac.views.authitem.unauthorized ', // optional defaults to //srbac.views.authitem.unauthorized, must be an existing alias 
			'alwaysAllowed'=>array(			 //optional defaults to gui 
				'SiteLogin','SiteLogout','SiteIndex','SiteAdmin', 
				'SiteError', 'SiteContact'), 
			'userActions'=>array(//optional defaults to empty array 
				'Show','View','List'), 
			'listBoxNumberOfLines' => 15,  //optional defaults to 10 
			'imagesPath' => 'srbac.images', //optional defaults to srbac.images 
			'imagesPack'=>'noia', //optional defaults to noia 
			'iconText'=>true, //optional defaults to false 
			'header'=>'srbac.views.authitem.header', //optional defaults to // srbac.views.authitem.header, must be an existing alias 
			'footer'=>'srbac.views.authitem.footer', //optional defaults to // srbac.views.authitem.footer, must be an existing alias 
			
			'showHeader'=>true, //optional defaults to false 
			'showFooter'=>true, //optional defaults to false 
			'alwaysAllowedPath'=>'srbac.components', //optional defaults to srbac.components // must be an existing alias 
		),


		'blog'=>array(
			"layout"=>"application.views.layouts.main",
		),
		'admin'=>array(
			"layout"=>"application.views.layouts.main",
		),
		'user'=>array(
			"layout"=>"application.views.layouts.main",
		),
		'group'=>array(
			"layout"=>"application.views.layouts.main",
			//"defaultController"=>"group"
		),
		'gift'=>array(
			'layout'=>'application.views.layouts.main',
//			"defaultController"=>"gift",
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'upload_dir'=>'/yiisns/uploads/images/',
		'uploadPath'=>$path.'/uploads/images/'
	),
);
