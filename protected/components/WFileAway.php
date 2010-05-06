<?php
/**
 * 时间归档.
 *
 */
class WFileAway extends CWidget
{
	public $data=array();
	public $url = 'friend';
	
	public function run()
	{
		$data = $this->data;


		
		$data['tableName'] = 'mini';
		$data['limit'] = 6;
		
		$date = date('Ym',time());
		$date = self::paramData( $date,$data['limit'],$data['tableName']);


		$data['date_list'] = $date;
		$data['alldate'] = '全部时间';

		$this->render('WFileAway',$data);
	}

	/**
	 * paramData
	 * 解析日期
	 * @param mixed $date 当前时间（200905格式）
	 * @param mixed $object 需要查询数据的object名.
	 * @static
	 * @access private
	 * @return void
	 */
	private  function paramData( $date,$limit = 6,$tableName){
		$year	 = $date[0].$date[1].$date[2].$date[3];
		$month	= $date[4].$date[5];
		$timestmp = mktime( 0,0,0,$month,1,$year );
		$object = $this->data['instance'];
		$condition = $this->data['condition'];

		if(!empty($condition))
		{
			foreach ( $condition as $key=>$value ){
				if( !is_numeric( $value ) ){
					$where[] = " `{$key}` = `{$value}` ";
				}else{
					$where[] = " `$key` = {$value}";
				}
			}
		}

		if( !empty( $where ) ){
			$where = implode( ' AND ',$where )." AND ";
		}
		
		//$model = $tableName::model();
		$model = call_user_func(array($tableName, 'model'));
		
		$tableName = $model->tableName();
		$criteria=new CDbCriteria;
		$criteria->order = 'ctime';
		$criteria->condition = 'uid = :uid';
		$criteria->params = array(':uid'=>Yii::app()->user->id);
		$oldest = $model->find();
		$oldest_ctime = $oldest->ctime;
		
		$oldest_month = date('Ym',$oldest->ctime);
		$month_arr = $this->getMonthArray($oldest_month,$date,6);
		
		
		foreach($month_arr as $key)
		{
			$time  = $this->getMonthData($key);
			$sql[] = "select '{$key}' as `time`,count(1) as count from  {$tableName} where {$where} ctime BETWEEN {$time[0]} AND {$time[1]}";
			$limit_time[$key]['content'] = $key;
		}

		$sql = implode( ' union all ',$sql );

		$result = $model->findAllBySql( $sql );
		if(!empty($result))
		{

			foreach ( $result as $value ){
				$limit_time[$value['time']]['count'] = $value['count'];
				
				if($limit_time[$value['time']]['count'] == 0)
				{
					//unset($limit_time[$value['time']]);
				}
			}
		}

		return $limit_time;
	}
	
	/**
	 * getMonthArray
	 * 获得两个年月之间的月份数组
	 * @param string $findTime 200903这样格式的参数
	 * @static
	 * @access protected
	 * @return void
	 */
	private function getMonthArray($start_month,$end_month,$limit = 0)
	{
		$month_arr = array();

		if(!empty($limit))
		{
			$start_month = strtotime('-'.$limit.' month');
			$start_month = date("Ym",$start_month);
		}
		while($start_month < $end_month)
		{
			$date = $end_month;
			$year = $date[0].$date[1].$date[2].$date[3];
			$month = $date[4].$date[5];
			$prev_month_timestmp = mktime(0,0,0,$month-1,1,$year);
			$prev_month = date("Ym",$prev_month_timestmp);
			if($start_month <= $prev_month)
			{
				$month_arr[] = $end_month;
			}
			$end_month = $prev_month;
		}
		return $month_arr;
	}
	/**
	 * getData
	 * 处理归档查询的时间格式
	 * @param string $date 200903这样格式的参数
	 * @static
	 * @access protected
	 * @return void
	 */
	private function getMonthData($date)
	{
		//echo $date."<br/>";
		$year = $date[0].$date[1].$date[2].$date[3];
		$month = $date[4].$date[5];
		$start = mktime(0,0,0,$month,1,$year);
		$end   = mktime(0,0,0,$month+1,1,$year);
		return array( $start,$end );
	}
	/**
	 * getData
	 * 处理归档查询的时间格式
	 * @param string $findTime 200903这样格式的参数
	 * @static
	 * @access protected
	 * @return void
	 */
	private function getData( $findTime ){
		//处理年份
		$year = $findTime[0].$findTime[1].$findTime[2].$findTime[3];
		//处理月份
		$month_temp = explode( $year,$findTime);
		$month = $month_temp[1];
		//归档查询
		if ( !empty( $month ) ){

			//判断时间.处理结束日期
			switch (true) {
				case ( in_array( $month,array( 1,3,5,7,8,10,12 ) ) ):
					$day = 31;
					break;
				case ( 2 == $month ):
					if( 0 != $year % 4 ){
						$day = 28;
					}else{
						$day = 29;
					}
					break;
				default:
					$day = 30;
					break;
			}
			//被查询区段开始时期的时间戳
			$start = mktime( 0, 0, 0 ,$month,1,$year  );

			//被查询区段的结束时期时间戳
			$end   = mktime( 24, 0, 0 ,$month,$day,$year  );

			//反之,某一年的归档
		}elseif( isset( $year[4] ) ){
			$start = mktime( 0, 0, 0, 1, 1, $year );
			$end = mktime( 24, 0, 0, 12,31, $year  );
		}else{
			//其他操作
		}

		//fd( array( friendlyDate($start),friendlyDate($end) ) );
		return array( $start,$end );

	}
	
		
}