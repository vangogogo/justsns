<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

include('Ts_common.php');

include './config.inc.php';
include './uc_client/client.php';

require_once($yii);
Yii::createWebApplication($config)->run();
