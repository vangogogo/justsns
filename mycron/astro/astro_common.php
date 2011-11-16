<?php
function tname($tablename)
{
    return 'yiisns_'.$tablename;
}

function getAstrosData()
{
	$mysql = new SaeMysql();
	$sql0 = "SELECT * FROM `".tname("astro")."` LIMIT 12";

	$astros = $mysql->getData($sql0);
	return $astros;
}
/*
* 获得图片数量，一般用来检查 星座 投票数
*/
function getImgCount($content)
{
	$img_tg = '/<img src=(.*?)\/>/ims';
	$num = preg_match_all($img_tg,$content,$test);
	return $num;
}

if(!defined('SAE_TMP_PATH'))
{
    include_once "SaeMysql.php";
}
