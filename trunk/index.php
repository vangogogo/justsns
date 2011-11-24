<?php
#error_reporting(E_ALL ^ E_NOTICE);die;
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii1.1/framework/yii.php';
$yii=dirname(__FILE__).'/../yii1.1/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
#defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

if(!empty($_SERVER['HTTP_HOST']))
{
    define('SUB_DOMAIN',$_SERVER['HTTP_HOST']);
}
else
{
    define('SUB_DOMAIN','www.yiisns.com');
}
define('Yii_Font_MicroHei',dirname(__FILE__).'/fonts/wqy-microhei.ttc');


include('Ts_common.php');

require_once($yii);
Yii::createWebApplication($config)->run();
