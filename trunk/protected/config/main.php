<?php
require('DatabaseConfig.php');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$path=dirname(dirname(dirname(__FILE__)));

$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'LockPHP',

	'timeZone' => 'Asia/Shanghai',
	//'sourceLanguage'=>'zh_cn',
	'language'=>'zh_cn',

	'theme' => 'blue',
	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        
		'application.extensions.helpers.*', //our extension
		'application.extensions.YiiMongoDbSuite.*', //our extension

		'application.extensions.CUplodifyWidget.*',
		'application.extensions.CDropDownMenu.*', //our extension
		'application.extensions.yiidebugtb.*', //our extension

		'application.extensions.yiicms.*', 
		'application.modules.user.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.models.*',
        'application.modules.rights.components.*',  

		'ext.bootstrap.widgets.*',
        'application.modules.astro.models.*',

        'application.modules.rights.*',
        'application.modules.rights.components.*',

	),

	// application components
	'components'=>array(
		'bootstrap'=>array('class'=>'ext.bootstrap.components.Bootstrap'),
        'mongodb' => array(
            'class'            => 'EMongoDB',
            'connectionString' => 'mongodb://admin:ho2p4e6j8y@192.168.1.222',
            'dbName'           => 'myDatabaseName',
            'fsyncFlag'        => true,
            'safeFlag'         => true,
            'useCursor'        => false
        ),
        'SAEOAuth' => array(
            'WB_AKEY' => '1500340182',
            'WB_SKEY' => 'c09b0ad5183707679d79e8bc24259c8c',
            'callback' => '/user/weibo/callback',
            'class'=>'SAEOAuth',
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),

        'request'=>array(
            //Cookie攻击的防范
            'enableCookieValidation'=>true,
            //跨站请求伪造(简称CSRF)攻击 防范
            #'enableCsrfValidation'=>true,
        ),
        // 用户组件
        'user'=>array(
            // 允许cookie自动登录 并保存到runtime/state.bin
            'allowAutoLogin'=>true,
			'class'=>'RWebUser',
            // session 前缀,单点登录与区分前后台登录时可以用到
            'stateKeyPrefix'=> 'f_site',

            // 登录链接 Yii::app()->user->loginUrl
            'loginUrl'=> array('/user/login'),

            //cookie 验证
            #'identityCookie'=>array('domain'=>'.'.ALL_DOMAIN,),
            
            //自动刷新 cookie
            #'autoRenewCookie'=>true,
        ),
        'db'=>array(
            //配置为 SAEDbConnection 则不必考虑用户名密码 并自动读写分离
            #'class'=>'SAEDbConnection',
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=yiisns',
            'username' => 'root',
            'password' => '111111',
            #'connectionString' => 'sqlite:protected/data/blog.db',
            'charset' => 'utf8',
			'tablePrefix'=>'yiisns_',
            'emulatePrepare' => true,
            //开启sql 记录
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
            //cache
            'schemaCachingDuration'=>3600,
        ),
        'session'=>array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'cookieParams' => array('domain' => '.'.ALL_DOMAIN, 'lifetime' => 0),
            'timeout' => 3600,
            'sessionName' => 'session'
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'urlManager'=>array(
            // 静态化
            //'urlSuffix'=>'.html',
            //路径模式的URL,方便SEO,搜索引擎搜索
             'urlFormat'=>'path',
            //不显示脚本名 index.php
            'showScriptName'=>false,
            //主域名 直接访问controllers
            #'baseUrl'=>'http://'.SUB_DOMAIN_main,
            'rules'=>array(
                //assets目录发布到web，使用path路径，浏览器会认为是静态文件*达到http304的目的
                'assets/<path:.*?>'=>'site/assets',

				'<_resource:(login|logout|help|contact)>'=>'site/<_resource>',
				#'<view:\w+>'=>'site/page',

				'space/<uid:\d+>'=>'space/index',
				#'space/<udomain:\w+>'=>'space/index',
				'post/<pid:\d+>'=>'post/show',

				#我的空间
				'group/<gid:\d+>'=>'group/group/show',
				'space/<id:\d+>/<_resource:(mini|blog|photo)>/'=>'<_resource>/index',

				#小组
				'group/<gid:\d+>'=>'group/group/show',
				'group/topic/<tid:\d+>'=>'group/topic/show',
				//'group/topic/tid/<tid:\d+>'=>'group/topic/view',
				'group/create/<gid:\d+>'=>'group/group/create',
				'group/<gid:\d+>/new_topic'=>'group/topic/create',
				'group/new_group'=>'group/group/create',
				#'group/<gid:\d+>/<_resource:(discussion|members|balck|update|requestJoin|join)>/'=>'group/group/<_resource>',
				'group/<gid:\d+>/<_resource>/'=>'group/group/<_resource>',
				'group/topic/<tid:\d+>/<_resource:(update|addPost|doDelPost|doDelTopic|doSwitch)>/'=>'group/topic/<_resource>',

				#星座
                'astro/<astro_id:\d+>-<name>-<year:\d+>-<month:\d+>-<day:\d+>.html'=>'astro/default/astro',
                'astro/<astro_id:\d+>-<name>.html'=>'astro/default/astro',
                #'astro/index.html'=>'astro/default/index',

                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                /*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, log',
				),*/
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('127.0.0.1'),
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
            //如果没有必要，不用修改缓存配置。 SAE不支持本地文件的IO处理 已经提供了memcache
            'class'=>'CFileCache',
            'directoryLevel'=>'2',
            'keyPrefix'=>'yiisns_'
        ),		    
		'authManager'=>array(
			// The type of Manager (Database)
			'class'=>'CDbAuthManager',
			'class'=>'RDbAuthManager',
			// 默认用户角色
			'defaultRoles'=>array('Authenticated', 'guest'),
			// The database connection used
			'connectionID'=>'db',
			// The itemTable name (default:authitem)
			#'itemTable'=>'auth_item',
			// The assignmentTable name (default:authassignment)
			#'assignmentTable'=>'auth_assignment',
			// The itemChildTable name (default:authitemchild)
			#'itemChildTable'=>'auth_item_child',
		),

        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            #'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
        ),
	),

	// application modules
	'modules'=>array(
		'api'=>array(
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=yiisns',
            'username' => 'root',
            'password' => '111111',
        ),
		'user'=>array(
			#"layout"=>"application.views.layouts.main",
		),
		'rights'=>array(
			'class'=>'application.modules.rights.RightsModule',

			'superuserName'=>'admin',                            // Name of the role with super user privileges. 
			'authenticatedName'=>'Authenticated',                // Name of the authenticated user role. 
			'userIdColumn'=>'id',                                // Name of the user id column in the database. 
			'userNameColumn'=>'username',                        // Name of the user name column in the database. 
			'enableBizRule'=>true,                               // Whether to enable authorization item business rules. 
			'enableBizRuleData'=>false,                          // Whether to enable data for business rules. 
			'displayDescription'=>true,                          // Whether to use item description instead of name. 
			'flashSuccessKey'=>'RightsSuccess',                  // Key to use for setting success flash messages. 
			'flashErrorKey'=>'RightsError',                      // Key to use for setting error flash messages. 
			'install'=>true,                                     // Whether to install rights. 
			'baseUrl'=>'/rights',                                // Base URL for Rights. Change if module is nested. 
			'layout'=>'rights.views.layouts.main',               // Layout to use for displaying Rights. 
			'appLayout'=>'backend.views.layouts.column2',       // Application layout. 
			#	'cssFile'=>'rights.css',                             // Style sheet file to use for Rights. 
			'install'=>false,                                    // Whether to enable installer. 
			'debug'=>false,                                      // Whether to enable debug mode. 
		),
		'group'=>array(
			"defaultController"=>"group"
		),
		'shop' => array(
			'debug' => true,
			'loginUrl' => array('/user/auth'),
			'currencySymbol' => '$',
			'termsView' => array('/myprojectspecific_controller/terms'),
			#'successView' => array('/myprojectspecific_controller/success'),
			#'failureView' => array('/myprojectspecific_controller/failure'),
			"layout"=>"application.views.layouts.main",
		),
		'gift',
        'astro',
	),
    'params'=>require(dirname(__FILE__).'/params.php'),
);
#$config['components']['assetManager'] = array('class' => 'SAEAssetManager','assetsAction'=> 'site/assets');
//如果定义了常量，则默认为在SAE环境中
if(defined('SAE_TMP_PATH'))
{
    //SAE 不支持I/O
    $config['runtimePath'] = SAE_TMP_PATH;
    //配置为 SAEDbConnection 则不必考虑用户名密码 并自动读写分离
    $config['components']['db'] = array(
            //配置为 SAEDbConnection 则不必考虑用户名密码 并自动读写分离
            'class'=>'SAEDbConnection',
            'charset' => 'utf8',
			'tablePrefix'=>'yiisns_',
            'emulatePrepare' => true,
            //开启sql 记录
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
            //cache
            'schemaCachingDuration'=>3600,
    );
    //SAE不支持I/O 使用storage 存储 assets。 如果在正式环境，请将发布到assets的css/js做合并，直接放到app目录下，storage的分钟限额为5000，app为200000
    //最新的SAE 不使用storage 而是在siteController中，导入了一个SAEAssetsAction，通过 site/assets?path=aaa.txt ，将文件内容输出到web端，来访问实际的 aaa.txt 文件，
    $config['components']['assetManager'] = array('class' => 'SAEAssetManager','assetsAction'=> 'site/assets');
    //如果没有必要，不用修改缓存配置。 SAE不支持本地文件的IO处理 已经提供了memcache
    $config['components']['cache'] = array('class'=> 'SAEMemCache');
	//SAE 不支持直接本地IO,又不想使用sae_debu(),直接改为db记录
	$config['components']['log']['routes']['base'] = array('class'=>'SAELogRoute','levels'=>'error, warning');
}
return $config;
