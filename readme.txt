
  敏捷高效的MVC框架：Yii是一个基于组件、用于开发大型 Web 应用的高性能 PHP 框架。

  Yii 有着丰富的功能：从 MVC, DAO/ActiveRecord, 到 主题化, 国际化 和本地化, Yii 提供了几乎所有今天的Web 2.0应用程序开发所需的功能。

  此版本为SAE平台的版本。

--------------------------------------------------------

  跨平台性，主要体现在一下几个方面。

（1）无缝迁移。

  如果你是原Yii的使用者，不用任何学习成本，使用Yii-SAE就和使用Yii框架本身一样。

（2）线下调试模式。

  本地可以直接进行程序调控，无需更改任何配置。

  原理在于SAE平台定义了 SAE_TMP_PATH 常量。根据判断 SAE_TMP_PATH 这个常量是否存在才读取配置信息。

（3）扩展式植入。

  在尽量不修改Yii源代码的基础上，写了一套以SAE开头的类，只需要在配置文件上配置。

  在SAE平台下，已经针对SAE平台提供的mysql，做了读写分离。在SEA平台下，不用修改数据库配置项。
  在SAE平台下，对本地I/O有很多限制，所以，runtimePath 配置为 SAE_TMP_PATH。 log 配置为 CDbLogRoute。 缓存则为 SAEMemCache

  提供两种 assets 无法生成的解决方案。
  1.发布到sae stroage，需要在sae中建立一个名叫 assets 的domain。当然 domain 你可以自己定义
        $config['components']['assetManager'] = array('class' => 'SAEAssetManager','domain'=> 'assets');

  2.使用site/assets?path=aaa.txt 来访问 aaa.txt 的原文件
        $config['components']['assetManager'] = array('class' => 'SAEAssetManager','assetsAction'=>'site/assets');
        并且在siteControllder.php加入一个action

	        public function actions()
	        {
		        return array(
			        'assets'=>array(
				        'class'=>'SAEAssetsAction',
			        ),
		        );
	        }
  强制使用第2种方法，因为sae的stroage的性能并不理想，并且stroage的分钟配置只有5000，而http则有 200000
  并且在 urlManager 加入一条 rules ，使用path路径，浏览器会认为是静态文件*达到http304的目的.
        'assets/<path:.*?>'=>'site/assets',


（4）文档齐全。

  Yii完备的文档，有着你学习和掌握它所需要的任何信息。

  Yii本身自带了许多基于jquery的功能扩展，社区还有许多无私的开发者为Yii制作了各式各样扩展功能。

（5）Yii的优点，还有许多许多...


------------------------------------------------------------

  使用方法:

  此核心只是扩展了Yii原有的类，需要把文件放在原来的核心文件夹中，将下载的文件解压到Yii的framework目录，替换原Yii的文件。

  然后需要在配置文件中，配置为扩展的SAE类。

  PS：后期会考虑将SAE配置写在框架中

  config/main.php 示例
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$config = array(
    //根目录 Yii::app()->basePath
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    //网站名称 Yii::app()->name
    'name'=>'yii-sae',
    #'theme'=>'pepper',
    //SAE 不支持I/O
    #'runtimePath' => SAE_TMP_PATH,
    //网站语言 多语言设置，对应 protected/messages/zh_cn
    'language'=>'zh_cn',
    //时区设置
    'timeZone' => 'Asia/Shanghai',
    //默认访问 即访问index.php时会自动跳转到某个controller
    'defaultController'=>'post',
    // 预先加载组件 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.hopecms.*',
        'application.modules.blog.models.*',
    ),
    //模块设置 设置后，同名module优先级高于contoller
    'modules'=>array(
        // 开启GII模块，不使用必须注释掉。
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'yiidev',
        ),
        'blog'=>array(),
    ),
    // 程序组件
    'components'=>array(
        'SAEOAuth' => array(
            'WB_AKEY' => '1500340182',
            'WB_SKEY' => 'c09b0ad5183707679d79e8bc24259c8c',
            'callback' => '/site/callback',
            'class'=>'SAEOAuth',
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

            // session 前缀,单点登录与区分前后台登录时可以用到
            #'stateKeyPrefix'=> 'f_site',

            // 登录链接 Yii::app()->user->loginUrl
            #'loginUrl'=> array('/site/login'),

            //cookie 验证
            #'identityCookie'=>array('domain'=>'.'.ALL_DOMAIN,),
            
            //自动刷新 cookie
            #'autoRenewCookie'=>true,
        ),
        'db'=>array(
            //配置为 SAEDbConnection 则不必考虑用户名密码 并自动读写分离
            #'class'=>'SAEDbConnection',
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=app_yiis',
            'username' => 'root',
            'password' => '111111',
            #'connectionString' => 'sqlite:protected/data/blog.db',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'emulatePrepare' => true,
            'schemaCachingDuration'=>3600,
        ),
        'session'=>array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            #'cookieParams' => array('domain' => '.'.ALL_DOMAIN, 'lifetime' => 0),
            #'timeout' => 3600,
            #'sessionName' => 'session'
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
                'post/<id:\d+>/<title:.*?>'=>'post/view',
                'posts/<tag:.*?>'=>'post/index',
                //assets目录发布到web，使用path路径，浏览器会认为是静态文件*达到http304的目的
                'assets/<path:.*?>'=>'site/assets',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    //SAE 不支持直接本地IO 改为db记录 
                    'class'=>'CDbLogRoute',
                    'connectionID'=>'db',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
                
            ),
        ),        
        /*
        'assetManager' => array(
            'class' => 'SAEAssetManager',
            //此处填写你在 SAE Storage 中创建得domain
            'domain'=> 'assets',
        ),
        */
        /*
        'cache'=>array(
            //如果没有必要，不用修改缓存配置。 SAE不支持本地文件的IO处理 已经提供了memcache
            'class'=>'CFileCache',
        ),
        */
        
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>require(dirname(__FILE__).'/params.php'),
);

//如果定义了常量，则默认为在SAE环境中
if(defined('SAE_TMP_PATH'))
{
    //SAE 不支持I/O
    $config['runtimePath'] = SAE_TMP_PATH;
    //配置为 SAEDbConnection 则不必考虑用户名密码 并自动读写分离
    $config['components']['db']['class'] = 'SAEDbConnection';
    //SAE不支持I/O 使用storage 存储 assets。 如果在正式环境，请将发布到assets的css/js做合并，直接放到app目录下，storage的分钟限额为5000，app为200000
    //最新的SAE 不使用storage 而是在siteController中，导入了一个SAEAssetsAction，通过 site/assets?path=aaa.txt ，将文件内容输出到web端，来访问实际的 aaa.txt 文件， 
    $config['components']['assetManager'] = array('class' => 'SAEAssetManager','domain'=> 'assets');
    //如果没有必要，不用修改缓存配置。 SAE不支持本地文件的IO处理 已经提供了memcache
    $config['components']['cache'] = array(
            'class'=> 'SAEMemCache',
            'servers'=>array(
                array('host'=>'localhost', 'port'=>11211, 'weight'=>100),
            ),
        );

}
return $config;
?>

  在SAE平台下上传文件，只能通过SAE的Storage，二次封装了一个stroage的操作类。（saedisk.class.php）
  如果你以后的app使用的是ckeditor/ckfinder的组合，那可以直接使用DEMO中提供的这两个组件。

  如果你使用的是自己开发的文件上传组件，那就参考saedisk.class.php做上传吧。：)




