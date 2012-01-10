<?php

class YiicmsHelper
{

	/**
	 * @var string $message 显示内容
	 * @var array $url 路由
	 * @var int $delay 跳转时间
	 * @var $type 显示样式
	 * 所有Controller的重定向跳转
	 */
	public function redirectMessage($message, $url = array('/'), $delay=3, $type = 'success' , $script='')
	{
		if($this->layout == 'main_sign')
		{
			$this->layout = 'main';
		}
		//$this->layout=false;

		if(is_array($url))
		{
			$route=isset($url[0]) ? $url[0] : '';
			$url=$this->createUrl($route,array_splice($url,1));
		}
		if(empty($url))
		{		
			$url = Yii::app()->request->urlReferrer;
		}
		if(empty($url))
		{
			$url = Yii::app()->request->baseUrl;
		}
		if(empty($url))
		{
			$url = '/';
		}

		$this->render('//redirect', array(
			'message' => $message,
			'url' => $url,
			'delay' => $delay,
			'script' => $script,
			'type' => $type,
		));
		exit;
	}
	
	static public function ok($message,$type='ok',$notification='true',$forwardUrl='',$callbackType='closeCurrent')
	{
		YiicmsHelper::responseAjax($message,$type,$notification,$forwardUrl,$callbackType);
	}
	static public function error($message,$type='error',$notification='true',$forwardUrl='',$callbackType='closeCurrent')
	{
		if ($message instanceof CModel){
			if ($message->hasErrors()){
				$message=preg_replace("/\n/",'',CHtml::errorSummary($message));
			}else
				$message='';
		}
		YiicmsHelper::responseAjax($message,$type,$notification,$forwardUrl,$callbackType);
	}
	
	static public function responseAjax($message,$type='ok',$notification='true',$forwardUrl='',$callbackType='')
	{

		$array = array(
			"type"=>$type,
			"message"=>$message, 
			"notification"=>$notification, 
			"callbackType"=>$callbackType,
			"forwardUrl"=>$forwardUrl,
		);
		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode($array);
			Yii::app()->end();
		}
	}

	static public function goBack()
	{
			$refer = Yii::app()->request->urlReferrer;
			Yii::app()->controller->redirect($refer);
    }

	/**
	 * 导出excel文件,
	 * 导出Excel5格式的XLS文件
	 *
	 * 在所有继承BaseController的Controller都可以调用本方法
	 *
	 * @param string $filename 文件名
	 * @param array $data 数据内容,二维数组
	 * @param array $name_arr 数据标题,与$data的二维数组的项目一一对应
	 * @return Void 无返回值,打开浏览器的下载页面
	 * -----------------------------------------------
		$static_array = array(
			1 => array('南山区','育合测试学校',0,0,0,0,0,0,0,,0,0,)
		);
		$filename = '学校vip数据';
		$name_arr = array(
			'区域','学校','总人数','定制vip人数','缴费人数','缴费金额','已审核记录数','已审核金额数','待审核记录数','待审核金额数'	
		);
		$this->downloadXls($filename,$static_array,$name_arr);
		
	 * -----------------------------------------------
	 * @author Biner 
	 * @date 2010-5-8
	 * @package PHPExcel
	 */
	public function downloadXls($filename,$data = array(),$name_arr = array(),$file_root = '',$data2=array(),$name_arr2 = array()) {

 		require_once('PHPExcel/IOFactory.php');
		require_once('PHPExcel/Writer/Excel5.php');

		if(empty($data))
		{
			die('空数据，无法导出！');
		}
		if(count($data[0]) != count($name_arr))
		{
			die('导出项目标题和数据项数目不一样。');
		}
		// 创建一个处理对象实例   
		$objExcel = new PHPExcel();
		// 创建文件格式写入对象实例, uncomment   
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);// 用于其他版本格式    

		$objExcel ->setActiveSheetIndex(0);    

		$objActSheet  = $objExcel ->getActiveSheet();    
		$objActSheet->setTitle('Sheet1');

		$outputFileName  = $filename.".xls" ;
		$outputFileName = iconv('utf-8', "GB18030", $outputFileName);

		if(!empty($data))
		{
			$row_array = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			//excel 表格 头
			if(!empty($name_arr))
			{
				$row = 1;
				$i = 0;
				foreach($name_arr as $name)
				{
					$objActSheet ->setCellValue($row_array[$i].$row , $name);
					$i ++;
				}
			}

			foreach($data as $key => $array)
			{
				$row = $key + 2;
				$i = 0;
				foreach($array as $one)
				{	
					$objActSheet ->setCellValue($row_array[$i].$row , $one);
					$i ++;
				}
			}
		}

		//卜智平添加
		if(!empty($data2))
		{
			$objExcel ->createSheet();
			$objExcel ->setActiveSheetIndex(1);    

			$objActSheet2  = $objExcel->getActiveSheet();    
			$objActSheet2->setTitle('Sheet2');

			$row_array2 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			//excel 表格 头
			if(!empty($name_arr2))
			{
				$row = 1;
				$i = 0;
				foreach($name_arr2 as $name2)
				{
					$objActSheet2 ->setCellValue($row_array2[$i].$row , $name2);
					$i ++;
				}
			}

			foreach($data2 as $key => $array2)
			{
				$row = $key + 2;
				$i = 0;
				foreach($array2 as $one2)
				{	
					$objActSheet2->setCellValue($row_array2[$i].$row , $one2);
					if($i==8 && str_replace('%','',$one2) > 50)
					{
						$objActSheet2->getStyle($row_array2[$i].$row)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
					}
					$i ++;
				}
			}
		}

		//到文件   
		if(!empty($file_root))
		{
			$objWriter->save($file_root);
			return true;
		}
		//
		//or   
		//到浏览器   
		header("Content-Type: application/force-download");   
		header("Content-Type: application/octet-stream");   
		header("Content-Type: application/download");   
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');   
		header("Content-Transfer-Encoding: binary");   
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");   
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   
		header("Pragma: no-cache");   
		$objWriter->save('php://output'); 
	}
	
	/**
	* @author: jason
	* @date: 2010-11-24下午03:14:09
	* @description: 字符串截取
	* @param = array(
	* 		$str=>要截取的字符串,
	* 		$num=>截取为多少个字,
	* );
	*
	*/
	static function cutString($str,$num,$charset="utf-8")
	{
		#$num = 3 * $num;
		if(mb_strlen($str,$charset) > $num)
		{
			$result = mb_substr($str,0,$num,$charset)."...";
		}
		else
		{
			$result = $str;
		}
		return $result;
	}
	
	static function friendlyDate($show='y-m-d H:i',$sTime,$type = 'normal',$alt = 'false') {
		if(!$sTime) {
			return '';
		}
		//sTime=源时间，cTime=当前时间，dTime=时间差
		$cTime		=	time();
		if(!is_numeric($sTime))
		{
			$sTime      =   strtotime($sTime);
		}
		$dTime		=	$cTime - $sTime;
		$dDay		=	intval(date("Ymd",$cTime)) - intval(date("Ymd",$sTime));
		$dYear		=	intval(date("Y",$cTime)) - intval(date("Y",$sTime));
		//normal：n秒前，n分钟前，n小时前，日期
		if($dTime < 0)
		{
			return date($show,$sTime);
		}
		if($type=='normal') {
			if( $dTime < 3 ){
				return "刚刚";
			}
			if( $dTime < 60 ) {
				return $dTime."秒前";
			}elseif( $dTime < 3600 ) {
				return intval($dTime/60)."分钟前";
			}elseif( $dTime >= 3600 && $dDay == 0  ) {
				return intval($dTime/3600)."小时前";
			}elseif($dYear==0) {
				return date($show,$sTime);
			}else {
				return date($show,$sTime);
			}
			//full: Y-m-d , H:i:s
		}elseif($type=='full') {
			return date($show,$sTime);
		}elseif($type=='month') {
			return date("m-d H:i",$sTime);
		}else {
			if( $dTime < 60 ) {
				return $dTime."秒前";
			}elseif( $dTime < 3600 ) {
				return intval($dTime/60)."分钟前";
			}elseif( $dTime >= 3600 && $dDay == 0  ) {
				return intval($dTime/3600)."小时前";
			}elseif($dYear==0) {
				return date($show,$sTime);
			}else {
				return date($show,$sTime);
			}
		}
	}

	/**
	* 判断是否登录，没有登录打印_showLogin
	*/
	static function _cklogin() {
		if(Yii::app()->user->isGuest)
		{
			echo ' _showLogin';
		}
	}
	
	static function CMarkdown($string,$purifyOutput = false)
	{
		$m = new CMarkdownParser;
		$output = $m->transform($string);
		
		if($purifyOutput)
		{
			$purifier=new CHtmlPurifier;
			$output=$purifier->purify($output);
		}
		return $output;
		
		Yii::app()->controller->beginWidget('CMarkdown', array('purifyOutput'=>$purifyOutput));
			echo $string;
		Yii::app()->controller->endWidget();
	}
}
