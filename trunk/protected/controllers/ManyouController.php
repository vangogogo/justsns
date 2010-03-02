<?php

class ManyouController extends Controller
{

	public function actionIndex()
	{

		$appid = Yii::app()->request->getParam('id');

		$_SGLOBAL['supe_uid'] = Yii::app()->user->id;
		$_SCONFIG['my_siteid'] = 'tst';
		//漫游
		$my_appId = $appid;
		$my_suffix = base64_decode(urldecode($_GET['my_suffix']));


		$my_prefix = Yii::app()->baseUrl;


		/*
		//奖励积分
		getreward('useapp', 1, 0, $appid);

		if (!$my_suffix) {
			header('Location: userapp.php?id='.$my_appId.'&my_suffix='.urlencode(base64_encode('/')));
			exit;
		}
		*/

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
		echo $url;
		//$current_url = getsiteurl().'userapp.php';
		if ($_SERVER['QUERY_STRING']) {
			$current_url = $current_url.'?'.$_SERVER['QUERY_STRING'];
		}

		$extra = $_GET['my_extra'];
		$timestamp = $_SGLOBAL['timestamp'];
		$url .= '&my_current='.urlencode($current_url);
		$url .= '&my_extra='.urlencode($extra);
		$url .= '&my_ts='.$timestamp;
		$url .= '&my_appVersion='.$app['version'];
		$hash = $_SCONFIG['my_siteid'].'|'.$_SGLOBAL['supe_uid'].'|'.$appid.'|'.$current_url.'|'.$extra.'|'.$timestamp.'|'.$_SCONFIG['my_sitekey'];
		$hash = md5($hash);
		$url .= '&my_sig='.$hash;
		$my_suffix = urlencode($my_suffix);


	$url ='http://uchome.manyou.com/userapp/privacy?appId=1021978&my_extra=&s_id=2240353&uch_id=1&uch_url=http%3A%2F%2Fhome.lockphp.com%2Fcp.php%3Fac%3Duserapp&my_suffix=%2Fuserapp%2Fprivacy%3FappId%3D1021978&timestamp=1267428495&my_sign=d667b77c929f16ba0744a9896619a43f';
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
}
