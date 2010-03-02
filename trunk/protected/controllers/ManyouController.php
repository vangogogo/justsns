<?php

class ManyouController extends Controller
{

	public function actionIndex()
	{
	global $_SCONFIG;
	$_SCONFIG=Array
	(
	'sitename' => '我的空间',
	'template' => 'default',
	'adminemail' => 'webmaster@home.lockphp.com',
	'onlinehold' => 1800,
	'timeoffset' => 8,
	'maxpage' => 100,
	'starcredit' => 100,
	'starlevelnum' => 5,
	'cachemode' => 'database',
	'cachegrade' => '0',
	'allowcache' => 1,
	'allowdomain' => '0',
	'allowrewrite' => '0',
	'allowwatermark' => '0',
	'allowftp' => '0',
	'holddomain' => 'www|*blog*|*space*|x',
	'mtagminnum' => 5,
	'feedday' => 7,
	'feedmaxnum' => 100,
	'feedfilternum' => 10,
	'importnum' => 100,
	'maxreward' => 10,
	'singlesent' => 50,
	'groupnum' => 8,
	'closeregister' => '0',
	'closeinvite' => '0',
	'close' => '0',
	'networkpublic' => 1,
	'networkpage' => 1,
	'seccode_register' => 1,
	'uc_tagrelated' => 1,
	'manualmoderator' => 1,
	'linkguide' => 1,
	'showall' => 1,
	'sendmailday' => '0',
	'realname' => '0',
	'namecheck' => '0',
	'namechange' => '0',
	'name_allowviewspace' => 1,
	'name_allowfriend' => 1,
	'name_allowpoke' => 1,
	'name_allowdoing' => 1,
	'name_allowblog' => '0',
	'name_allowalbum' => '0',
	'name_allowthread' => '0',
	'name_allowshare' => '0',
	'name_allowcomment' => '0',
	'name_allowpost' => '0',
	'showallfriendnum' => 10,
	'feedtargetblank' => 1,
	'feedread' => 1,
	'feedhotnum' => 3,
	'feedhotday' => 2,
	'feedhotmin' => 3,
	'feedhiddenicon' => 'friend,profile,task,wall',
	'uc_tagrelatedtime' => 86400,
	'privacy' => Array
		(
		'view' => Array
			(
			'index' => '0',
			'profile' => '0',
			'friend' => '0',
			'wall' => '0',
			'feed' => '0',
			'mtag' => '0',
			'event' => '0',
			'doing' => '0',
			'blog' => '0',
			'album' => '0',
			'share' => '0',
			'poll' => '0'
			),
		'feed' => Array
			(
			'doing' => 1,
			'blog' => 1,
			'upload' => 1,
			'share' => 1,
			'poll' => 1,
			'joinpoll' => 1,
			'thread' => 1,
			'post' => 1,
			'mtag' => 1,
			'event' => 1,
			'join' => 1,
			'friend' => 1,
			'comment' => 1,
			'show' => 1,
			'spaceopen' => 1,
			'credit' => 1,
			'invite' => 1,
			'task' => 1,
			'profile' => 1,
			'album' => 1,
			'click' => 1
			)
		),
	'cronnextrun' => 1266959160,
	'my_status' => '0',
	'uniqueemail' => 1,
	'updatestat' => 1,
	'my_showgift' => 1,
	'topcachetime' => 60,
	'newspacenum' => 3,
	'sitekey' => 'be005cfbz97A9aGD',
	'my_siteid' => 2240353,
	'my_sitekey' => 'e815df5089039da4ea78b3f9ccca845f',
	'spacebarusername' => 'huanghuibin'
	);
		$appid = Yii::app()->request->getParam('id');

		$_SGLOBAL['supe_uid'] = Yii::app()->user->id;

		$_SCONFIG['my_siteid'] = '2240353';

		//漫游
		$my_appId = $appid;
		$my_suffix = base64_decode(urldecode($_GET['my_suffix']));

		$my_prefix = $this->getsiteurl();
		//$my_prefix = 'http://home.lockphp.com/';
		//奖励积分
		//getreward('useapp', 1, 0, $appid);

		if (!$my_suffix) {
		    header('Location: index.php?r=manyou&id='.$my_appId.'&my_suffix='.urlencode(base64_encode('/')));
		    exit;
		}

		if (preg_match('/^\//', $my_suffix)) {
		    $url = 'http://apps.manyou.com/'.$my_appId.$my_suffix;
		} else {
		    if ($my_suffix) {
		        $url = 'http://apps.manyou.com/'.$my_appId.'/'.$my_suffix;
		    } else {
		        $url = 'http://apps.manyou.com/'.$my_appId;
		    }
		}
		if (strpos($my_suffix, '?')) {
		    $url = $url.'&my_uchId='.$_SGLOBAL['supe_uid'].'&my_sId='.$_SCONFIG['my_siteid'];
		} else {
		    $url = $url.'?my_uchId='.$_SGLOBAL['supe_uid'].'&my_sId='.$_SCONFIG['my_siteid'];
		}
		$url .= '&my_prefix='.urlencode($my_prefix).'&my_suffix='.urlencode($my_suffix);
		//$current_url = $this->getsiteurl().'userapp.php';
		$current_url = $this->getsiteurl().'index.php';
		if ($_SERVER['QUERY_STRING']) {
		    $current_url = $current_url.'?'.$_SERVER['QUERY_STRING'];
		}
		$app['version'] = 0;
		$extra = $_GET['my_extra'];
		$timestamp = time();
		$url .= '&my_current='.urlencode($current_url);
		$url .= '&my_extra='.urlencode($extra);
		$url .= '&my_ts='.$timestamp;
		$url .= '&my_appVersion='.$app['version'];
		$hash = $_SCONFIG['my_siteid'].'|'.$_SGLOBAL['supe_uid'].'|'.$appid.'|'.$current_url.'|'.$extra.'|'.$timestamp.'|'.$_SCONFIG['my_sitekey'];
		$hash = md5($hash);
		$url .= '&my_sig='.$hash;
		$my_suffix = urlencode($my_suffix);

		//include_once template("userapp");
		$data = array(
			'my_prefix'=>$my_prefix,
			'my_suffix'=>$my_suffix,
			'my_appId'=>$my_appId,
			'my_site_name'=>$my_site_name,
			'url'=>$url
		);
		$this->render('index',$data);
	}
	
	//站点链接
	function getsiteurl() {
		global $_SCONFIG;

		if(empty($_SCONFIG['siteallurl'])) {
			$uri = $_SERVER['REQUEST_URI']?$_SERVER['REQUEST_URI']:($_SERVER['PHP_SELF']?$_SERVER['PHP_SELF']:$_SERVER['SCRIPT_NAME']);
			return $this->shtmlspecialchars('http://'.$_SERVER['HTTP_HOST'].substr($uri, 0, strrpos($uri, '/')+1));
		} else {
			return $_SCONFIG['siteallurl'];
		}
	}
	
	//取消HTML代码
	function shtmlspecialchars($string) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = shtmlspecialchars($val);
			}
		} else {
			$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
				str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
		}
		return $string;
	}	
}
