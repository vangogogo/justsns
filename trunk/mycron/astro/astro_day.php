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
		$tmp =getAstroDay($astro_name,$day);
		$tmp['astro_id'] = $one['astro_id'];
		$data[] = $tmp;
		$sql = getAstroDaySql($tmp);
		$mysql->runSql( $sql );
	}
	if( $mysql->errno() != 0 )
	{
		print_r( "Error:" . $mysql->errmsg() );
	}
}

$mysql->closeDb();

function getAstroDaySql($params)
{
		$sql = 'insert '.tname("astro_day").'(';
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
function getAstroDay($astor_name = '',$day = '')
{
	if(empty($astor_name))
	{
		return false;
	}
	if(empty($day))
	{
		$day = date('Ymd',strtotime("+1 day"));
	}
	$url = "http://vip.astro.sina.com.cn/astro/view/{$astor_name}/day/{$day}";
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

	$tg = "/<div class=\"lotconts\">(.*?)<\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['content'] = $matches[1];

	$tg = "/<div class=\"tab\"><h4>综合运势<\/h4><p>(.*?)<\/p>/ims";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['sum'] = $num;

	$tg = "/<div class=\"tab\"><h4>爱情运势<\/h4><p>(.*?)<\/p>/ims";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['love'] = $num;

	$tg = "/<div class=\"tab\"><h4>工作状况<\/h4><p>(.*?)<\/p>/ims";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['work'] = $num;

	$tg = "/<div class=\"tab\"><h4>理财投资<\/h4><p>(.*?)<\/p>/ims";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['money'] = $num;

	$tg = "/<div class=\"tab\"><h4>健康指数<\/h4><p>(.*?)<\/p><\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['health'] =  str_replace('%','',$matches[1]);

	$tg = "/<div class=\"tab\"><h4>商谈指数<\/h4><p>(.*?)<\/p><\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['bussiness'] = str_replace('%','',$matches[1]);

	$tg = "/<div class=\"tab\"><h4>幸运颜色<\/h4><p>(.*?)<\/p><\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['luck_color'] = $matches[1];

	$tg = "/<div class=\"tab\"><h4>幸运数字<\/h4><p>(.*?)<\/p><\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['luck_num'] = $matches[1];

	$tg = "/<div class=\"tab\"><h4>速配星座<\/h4><p>(.*?)<\/p><\/div>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['luck_astro'] = $matches[1];

	$data['day'] = $day;

	return $data;
}
