<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii1.1/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

include('Ts_common.php');

require_once($yii);
Yii::createWebApplication($config)->run();
