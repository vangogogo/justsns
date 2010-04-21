<?php
require('DatabaseConfig.php');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$path=dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'..';
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
				*/
				array( // configuration for the toolbar
				  'class'=>'XWebDebugRouter',
				  'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
				  'levels'=>'error, warning, trace, profile, info',
				),
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
			'urlFormat'=>'path',
			// show www.example.com/index.php/controller/action
			// or just www.example.com/controller/action
			'showScriptName' => false,
			// rules to redirect a specific url to the controller you want
			// see: http://www.yiiframework.com/doc/guide/topics.url
			'rules'=>array(
				// www.example.com/home instead of www.example.com/site/index
				'home'=>'site/index',
				'post/<id:\d+>'=>'post/show',

				'group/topic/<cate_id:\d+>'=>'group/topic/show/<cate_id:\d+>',
			),
		),
		//验证模块
		'jformvalidate' => array (
			'class' => 'application.extensions.jformvalidate.EJFValidate'
		),
	),

	// application modules
	'modules'=>array(
		'srbac'=>array(
			// Your application's user class (default: User)
			"userclass"=>"user",
			// Your users' table user_id column (default: userid)
			"userid"=>"id",
			// your users' table username column (default: username)
			"username"=>"username",
			// If in debug mode (default: false)
			// In debug mode every user (even guest) can admin srbac, also
			//if you use internationalization untranslated words/phrases
			//will be marked with a red star
			"debug"=>false,
			// The number of items shown in each page (default:15)
			"pageSize"=>20,
			// The name of the super user
			"superUser" =>"Authority",

			"layout"=>"application.modules.admin.views.layouts.main",
			"imagesPack"=>"tango",


			// The always allowed actions
			"alwaysAllowed"=>array(
			'SiteLogin','SiteLogout','SiteIndex','SiteAdmin',
			'SiteError', 'SiteContact'),
			// The operationa assigned to users
			"userActions"=>array(
			"Show","View","List"
			),
			//The number of lines in assign listboxes (default 10)
			"listBoxNumberOfLines" => 15,
			// The images pack to use
			"imagesPack"=>"noia",
			//Display text next to the icons or not
			"iconText"=>true,
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
		),
		'gift'=>array(
			'layout'=>'application.views.layouts.main',
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
