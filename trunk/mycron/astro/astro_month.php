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
		$tmp =getAstroMonth($astro_name);
		$tmp['astro_id'] = $one['astro_id'];
		$data[] = $tmp;
		$sql = getAstroMonthSql($tmp);
		$mysql->runSql( $sql );
	}
	if( $mysql->errno() != 0 )
	{
		print_r( "Error:" . $mysql->errmsg() );
	}
}

$mysql->closeDb();

function getAstroMonthSql($params)
{
		$sql = 'replace '.tname("astro_month").'(';
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
function getAstroMonth($astor_name = '',$day = '')
{
	if(empty($astor_name))
	{
		return false;
	}
	if(empty($month))
	{
		$month = date('Ym');
	}
	$url = "http://vip.astro.sina.com.cn/astro/view/{$astor_name}/monthly/";
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

	$tg = "/<h4>整体运势(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['sum'] = $num;
	$data['sum_content'] = $matches[3];

	$tg = "/<h4>爱情运势(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['love'] = $num;
	$data['love_content'] = $matches[3];

	$tg = "/<h4>投资理财运(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$num = getImgCount($matches[1]);
	$data['money'] = $num;
	$data['money_content'] = $matches[3];

	$tg = "/<h4>解压方式(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$data['relax_way'] = $matches[3];

	$tg = "/<h4>开运小秘诀(.*?)<\/h4>(.*?)<p>(.*?)<\/p>/is";
	$d = preg_match($tg,$content,$matches);
	$data['luck_way'] = $matches[3];

	$data['month'] = $month;

	return $data;
}
