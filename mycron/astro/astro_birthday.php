<?php
include('astro_common.php');


$mysql = new SaeMysql();



    for($month=1;$month<=12;$month++)
    {

        $last_day = date(t,strtotime( "2004/{$month}/1"));
        for($day=1;$day<=$last_day;$day++)
        {
            echo "{$month}月{$day}日<br/>";
            $tmp = getBirthDay($month,$day);
		    $sql = getBirthDaySql($tmp);
		    $mysql->runSql( $sql );
	        if( $mysql->errno() != 0 )
	        {
                print_r($sql);
		        print_r( "Error:" . $mysql->errmsg() );
	        }
        }
        
    }



$mysql->closeDb();

function getBirthDaySql($params)
{
		$sql = 'replace '.tname("astro_birthday").'(';
		foreach($params as $attribute => $value)
		{
			$sql .= "`".$attribute."`,";
		}
		$sql .= ') values (';
		foreach($params as $attribute => $value)
		{
			$value = trim($value);
            $value = str_replace("<br>","",$value);
            $value = str_replace("'",'"',$value);
            #$value = mb_convert_encoding($value,"UTF-8","gb2312");
			$sql .= "'".$value."',";
		}
		$sql .= ');';
		$sql = str_replace(",)",")",$sql);

		return $sql;
}
function getBirthDay($month = '',$day = '')
{
	$url = "http://shengxiao.1518.com/shengri-{$month}-{$day}";
	  $ch=curl_init();
	  curl_setopt($ch,CURLOPT_URL,$url);
	  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	  $content=curl_exec($ch);
	  if(curl_errno($ch)) echo curl_error($ch);
	  #else echo $content;
	  curl_close($ch);

    $content = mb_convert_encoding($content,"UTF-8","gb2312");
    $content = str_replace(" ","",$content);

	$tg = "/<h1>{$month}月{$day}日(.*?)<\/h1>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['birthday_title'] = $matches[1];

	$tg = "/<\/script><\/span>(.*?)<b>幸/ims";
	$d = preg_match($tg,$content,$matches);
	$data['birthday_content'] = $matches[1];


	$tg = "/<b>幸运数字和守护星<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['luck_content'] = $matches[1];

	$tg = "/<b>健康<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['health_content'] = $matches[1];

	$tg = "/<b>建议<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['suggest_content'] = $matches[1];

	$tg = "/<b>名人<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['people_content'] = $matches[1];

	$tg = "/<b>塔罗牌<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['taluo_content'] = $matches[1];

	$tg = "/<b>静思语<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['keyword'] = $matches[1];

	$tg = "/<b>优点<\/b>(.*?)<b>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['benefits'] = $matches[1];

	$tg = "/<b>缺点<\/b>(.*?)<\/p>/ims";
	$d = preg_match($tg,$content,$matches);
	$data['shortcomings'] = $matches[1];


    $data['birthday_month'] = $month;
	$data['birthday_day'] = $day;

	return $data;
}
