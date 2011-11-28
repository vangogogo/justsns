<?php
include('astro_common.php');
$astros = getAstrosData();

$mysql = new SaeMysql();
$day = date('Ymd',strtotime("+1 day"));

if(!empty($astros))
{
	foreach($astros as $one)
	{
		$astro_name = strtolower($one['astro_name_en']);
		echo $day."\n";
		$tmp =getAstroWeek($astro_name,$day);
		$tmp['astro_id'] = $one['astro_id'];
		$data[] = $tmp;
		$sql = getAstroWeekSql($tmp);
		$mysql->runSql( $sql );
	}
	if( $mysql->errno() != 0 )
	{
		print_r( "Error:" . $mysql->errmsg() );
	}
}

$mysql->closeDb();

function getAstroWeekSql($params)
{
		$sql = 'insert '.tname("astro_week").'(';
		foreach($params as $attribute => $value)
		{
			$sql .= "`".$attribute."`,";
		}
		$sql .= ') values (';
		foreach($params as $attribute => $value)
		{
			$value = trim($value);
			$sql .= "'".$value."',";
		}
		$sql .= ');';
		$sql = str_replace(",)",")",$sql);

		return $sql;
}
function getAstroWeek($astor_name = '',$day = '')
{
	if(empty($astor_name))
	{
		return false;
	}
	if(empty($day))
	{
		$day = date('Ymd');
	}

	$url = "http://vip.astro.sina.com.cn/astro/view/{$astor_name}/weekly";
	echo $url."\n";
	  $ch=curl_init();
	  curl_setopt($ch,CURLOPT_URL,$url);
	  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	  $content=curl_exec($ch);
	  if(curl_errno($ch)) echo curl_error($ch);
	  #else echo $content;
	  curl_close($ch);

	$tg = "/作者\／(.*?)<\/cite>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['author'] = $matches[1];

	$tg = "/<li class=\"notes\">(.*?)<\/li>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['content'] = $matches[1];

	$tg = "/<h4>整体运势(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['sum'] = $num;
	$data['sum_content'] = $matches[3];

	$tg = "/<h4>爱情运势(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	//有对象 无对象
	$tg = "/<h4>爱情运势<\/h4>(.*?)<em>有对象:(.*?)<\/em>(.*?)<em>没对象:(.*?)<\/em>(.*?)<\/div>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[2]);
	$data['love'] = $num;
	$data['love_content'] = $matches[3];

	$num = getImgCount($matches[4]);
	$data['love_no'] = $num;
	$data['love_content_no'] = $matches[5];

	$tg = "/<h4>健康运势(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['study'] = $num;
	$data['study_content'] = $matches[3];

	$tg = "/<h4>工作学业运(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['work'] = $num;
	$data['work_content'] = $matches[3];

	$tg = "/<h4>性欲指数(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['sex'] = $num;
	$data['sex_content'] = $matches[3];

	$tg = "/<h4>红心日<\/h4>(.*?)<p>(.*?)<br \/>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$data['red'] = $matches[2];
	$data['red_content'] = $matches[3];

	$tg = "/<h4>黑梅日<\/h4>(.*?)<p>(.*?)<br \/>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$data['black'] = $matches[2];
	$data['black_content'] = $matches[3];



	
	$date = date('Y-m-d');
	$ret = getWeekRange($date);

	$data['day'] = date('Ymd');
	$data['day_start'] = $ret['day_start'];
	$data['day_end'] = $ret['day_end'];
	//星期开始日
	
	//星期结束日

	return $data;
}

function getWeekRange($date)
{
	//偏移两天
	$date = date('Ymd',strtotime($date)+2*86400);
    $ret=array();
    $timestamp=strtotime($date);
    $w=strftime('%u',$timestamp);
    $ret['day_start']=date('Ymd',$timestamp-(($w+2)-1)*86400);
    $ret['day_end']=date('Ymd',$timestamp+(7-($w+2))*86400);
    return $ret;
}
