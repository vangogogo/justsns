<?php

/**
 * @author: jason
 * @date: 2010-10-29下午01:56:10
 * @description: 公共类
 *
 */
class m_common
{
	//define('UC_API', 'http://192.168.1.222/uc'); // UCenter 的 URL 地址, 在调用头像时依赖此常量
	/**
	 * @author: jason
	 * @date: 2010-10-29下午01:56:56
	 * @description: 显示个人头像
	 *
	 */
	public function avatar($uid, $size='small', $returnsrc = FALSE) {
		global $_SCONFIG, $_SN;

		$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'small';
		$avatarfile = $this->avatar_file($uid, $size);
		return $returnsrc ? UC_API.'/data/avatar/'.$avatarfile : '<img src="'.UC_API.'/data/avatar/'.$avatarfile.'?'.rand(1,999).'" onerror="this.onerror=null;this.src=\''.UC_API.'/images/noavatar_'.$size.'.gif\'">';
	}

	/**
	 * @author: jason
	 * @date: 2010-10-29下午01:56:56
	 * @description: 依用户ID得到个人头像
	 *
	 */
	public function avatar_file($uid, $size) {
		global $_SGLOBAL, $_SCONFIG;

		$type = empty($_SCONFIG['avatarreal'])?'virtual':'real';
		$var = "avatarfile_{$uid}_{$size}_{$type}";
		if(empty($_SGLOBAL[$var])) {
			$uid = abs(intval($uid));
			$uid = sprintf("%09d", $uid);
			$dir1 = substr($uid, 0, 3);
			$dir2 = substr($uid, 3, 2);
			$dir3 = substr($uid, 5, 2);
			$typeadd = $type == 'real' ? '_real' : '';
			$_SGLOBAL[$var] = $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
		}
		return $_SGLOBAL[$var];
	}
	
	/**
	 * @author: jason
	 * @date: 2010-11-1上午11:29:10
	 * @description: 获得用户信息
	 *
	 */
	public function getUserInfo()
	{
		$userinfo = array();
		$user_id = Yii::app()->user->id;
		$user_name = Yii::app()->user->name;
		
		$userinfo = array(
			'user_id'=>$user_id,
			'user_name'=>$user_name,
		);
		return $userinfo;
	}
	
	/**
	 * @author: jason
	 * @date: 2010-11-3下午04:01:28
	 * @description: 上传文件
	 *
	 */
	public function actionUpload()
	{
		$m_attach = new m_attachment();
    	$r = $m_attach->attachmentSave();
    	exit($r);
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-6下午05:41:26
	 * @todo:获得登录链接
	 * @return: 
	 *
	 */ 
	public function getLoginUrl()
	{

		$result = Yii::app()->createUrl('user/default/login');

		return $result;
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-9上午10:58:40
	 * @description: 检查是否已登录
	 *
	 */
    public function checkLogin()
    {
		if(Yii::app()->user->isGuest)
		{
			// 判断是否为Ajax请求
			if(Yii::app()->request->isAjaxRequest)
			{
	    		$error = '请您登陆后 再执行本操作。';
				$r = json_encode(array('error'=>$error,'msg'=>$msg,'id'=>$new_id));	
		    	exit($r);
			}
			else 
			{
				//throw new CHttpException(404,'请您登陆后 再执行本操作。.');
				return 1;
			}
		}
    }
    
   
	/*
	$rowCount=$command->execute();   // 执行无查询 SQL
	$dataReader=$command->query();   // 执行一个 SQL 查询
	$rows=$command->queryAll();      // 查询并返回结果中的所有行
	$row=$command->queryRow();       // 查询并返回结果中的第一行
	$column=$command->queryColumn(); // 查询并返回结果中的第一列
	$value=$command->queryScalar();  // 查询并返回结果中第一行的第一个字段	
	*/	
	
	/**
	 * @author: Biner
	 * @date: 2010-12-13下午02:23:42
	 * @description: 大家都在说，即是uchome的心情
	 */	
	public function getSaying($limit = 8)
	{	
		$connection=Yii::app()->db_uchome; 
		$sql = "select * from uchome_doing order by dateline DESC,replynum DESC limit {$limit}";
		$command=$connection->createCommand($sql);
		$rows = $command->queryAll();
		return $rows;
	}
	
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 友情链接/合作伙伴
	 * @params: $cate_id 0广告 1图片链接（合作伙伴） 2文字链接（推荐链接）
	 */	
	public function getAdlist($limit = 8,$cate_id = 0,$location_id = 0)
	{	
		$rows = Ad::model()->getAdList($limit,$cate_id,$location_id);
		return $rows;
	}
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 获得合作伙伴
	 */	
	public function getPartners($limit = 16)
	{
		$rows = Ad::model()->getAdList($limit,1);
		return $rows;
	}
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 获得推荐链接
	 */	
	public function getLinks($limit = 8)
	{
		$rows = Ad::model()->getAdList($limit,2);
		return $rows;		
	}
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 获得广告
	 */	
	public function getAds($limit = 8,$location_id)
	{
		if($limit == 0)
		{
			$rows = array();
		}
		else 
			$rows = Ad::model()->getAdList($limit,0,$location_id);
		return $rows;
	}
	
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 获得广告
	 */	
	public function getAllAds()
	{
		$all_ads = array();
		$rows = $this->getAdlist(0,0,0);
		if(!empty($rows))
		{
			foreach($rows as $one)
			{
				$array[$one->location_id][]=$one;
			}
		}
		return $all_ads;
	}
	/**
	 * @author: Biner
	 * @date: 2010-12-14上午02:23:42
	 * @description: 获得推荐
		1, '精彩日志', 2, '话题讨论',3, '图片新闻', 4, '大家的相册',5, '精彩活动',
		6, '相册展播',7, '热门群组',8, '热门活动',9, '热门日志', 10, '热门投票', 
	 */	
	public function getShowList($limit = 4,$cate_id)
	{
		$model = new Show();
		$model->cate_id = $cate_id;
		$key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($key);

		if($resource===false)
		{
			$connection=Yii::app()->db;
			$sql = "select * from {{main_show}} where 1 and is_delete = 0 and status = 1 and cate_id = $cate_id order by top DESC,sort DESC limit {$limit}";
			$command=$connection->createCommand($sql);
			$resource = $command->queryAll();
			
			if(!empty($resource))
			{
				foreach($resource as $key => $one)
				{
					if(empty($one['url']))
					{
						
						$url =$model->createCommendUrl($one['url'],$one['idtype'],$one['id']);
						$resource[$key]['url'] = $url;
					}
				}
			}

			Yii::app()->cache->set($key,$resource);
		}

		return $resource;
	}
	
	/**
	 * @author: Biner
	 * @date: 2010-12-29 上午12:23:42
	 * @description: 是fou有缓存
	 */	
	public function checkShowListCache($cate_id)
	{
		$model = new Show();
		$model->cate_id = $cate_id;
		$key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($key);

		if($resource===false)
		{
			return false;
		}
		return true;

	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-15上午10:51:50
	 * @todo: 获得博客明星
	 * @params:
	 */
	public function getBlogStarList($limit = 4)
	{
		$star_list = array();	
		// 先判断是否存在缓存，从缓存读取数据
		$model = new Blogstar();
		$cache_key =$model->getBlogstarListCacheKey();
		$source=Yii::app()->cache->get($cache_key);
		if($source === false)
		{
			$connection=Yii::app()->db;
			$sql = " select * from {{main_blogstar}} where 1 and is_delete != 1 order by sort DESC limit {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				// 遍历得到用户的省份，城市，身份等信息
				foreach($rows as $one)
				{
					$user_id = $one['star_user_id'];
					$uids[] = $user_id;
					$starinfo[$user_id]['star_id'] = $one['star_id'];
					$starinfo[$user_id]['resideprovince'] = $one['star_province'];
					$starinfo[$user_id]['residecity'] = $one['star_city'];
					$starinfo[$user_id]['identity'] = $one['star_identity'];
				}
			}
			
			// 判断不为空
			if(!empty($uids))
			{
				$imp_uids = implode(",", $uids);
			
				$conn = Yii::app()->db_uchome;
				$sql = " SELECT s.*, sf.resideprovince, sf.residecity
					FROM uchome_space s
					LEFT JOIN uchome_spacefield sf ON sf.uid=s.uid WHERE s.uid in ($imp_uids)
					ORDER BY s.blognum DESC LIMIT {$limit} "; 
				$command = $conn->createCommand($sql);
				$rows = $command->queryAll();
				if(!empty($rows))
				{
					foreach($rows as $value)
					{
		
						$_SN[$value['uid']] = $value['name'] ? $value['name'] : $value['username'];
					
						// add by jason 2010-10-11
						$star_uid = $value['uid'];
						
						$value['resideprovince'] = $starinfo[$star_uid]['resideprovince'] ? $starinfo[$star_uid]['resideprovince'] : $value['resideprovince'];
						$value['residecity'] = $starinfo[$star_uid]['residecity'] ? $starinfo[$star_uid]['residecity'] : $value['residecity'];
						
						// 依身份标识显示身份
						$identity_arr = array('1'=>'老师','2'=>'家长','3'=>'学生');
						foreach ($identity_arr as $key => $identity)
						{
							$identity_name[$key] = $identity;
						}
						
						// 用户名
						$value['name'] = YiicmsUchome::getUchomeRealname($value['uid']);
						
						$value['identity'] = $identity_name[$starinfo[$star_uid]['identity']];
						//$sort_id = $starinfo[$star_uid]['star_id'];
						$star_list[$value['uid']] = $value;
					}	
				}
		
				//ksort($star_list);
				foreach($uids as $key=>$id)
				{
					$source[$key] = $star_list[$id]; 
				}
				// 设置缓存
				Yii::app()->cache->set($cache_key,$source);
			}
		}
		return $source;
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-15上午11:33:19
	 * @todo: 获得热门群组
	 * @params:cate_id=7为群组类型
	 */
	public function getGroupList($limit = 4)
	{
		$cate_id = 7;
		$model = new Show();
		$model->cate_id = $cate_id;
		$cache_key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($cache_key);

		if(!$resource===false)
		{
			return $resource;
		}
		
		
		$relate_arr =  $group_list = array();
		
		
		$rows = $this->getShowList($limit,$cate_id);
		if(!empty($rows))
		{
			foreach ($rows as $value) {
				$show_id = $value['id'];
				// 先判断id值不为空
				if(!empty($show_id))
				{
					$relate_arr[] = $show_id;
					$show_arr[$show_id]['target_type'] = $value['target_type'];	
				}
			}
		}
		if(!empty($relate_arr))
		{
			$imp_ids = implode(",", $relate_arr);
			
			$connection=Yii::app()->db_uchome;
			$sql = " SELECT * FROM uchome_mtag where tagid in ($imp_ids) ORDER BY tagid  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				foreach ($rows as $value) {
					
					$value['target_type'] = $show_arr[$value['tagid']]['target_type'];
					$value['name'] = YiicmsUchome::getUchomeRealname($value['uid']);					
					$group_list[$value['tagid']] = $value;
				}
			}
			foreach($relate_arr as $key=>$id)
			{
				$source[$key] = $group_list[$id]; 
			}
			
			Yii::app()->cache->set($cache_key,$source);
		}
		//array_multisort($relate_arr, SORT_ASC, $source);
		return $source;
			
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-15下午01:51:35
	 * @todo: 获得专家列表
	 * @params:
	 */
	public function getExpertList($limit = 5)
	{
		$expert_list = array();
		$expert_cate = Expert::model()->getCateList();
		
		// 先判断是否存在缓存，从缓存读取数据
		$model = new Expert();
		$key =$model->getExpertListCacheKey();
		$resource=Yii::app()->cache->get($key);
		if($resource === false)
		{
			$connection=Yii::app()->db;
			$sql = " SELECT * FROM {{main_expert}} where is_delete = '0' and status= '1' ORDER BY is_top desc,sort desc  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$resource = $command->queryAll();
			
			// 设置缓存
			Yii::app()->cache->set($key,$resource);
		}
		if(!empty($resource))
		{
			foreach($resource as $one)
			{
				$id = $one['expert_id'];
		
				$expert_list[$id] = $one;
				$expert_list[$id]['cate'] =  $expert_cate[$one['cate_id']];
				$expert_list[$id]['expert_intro'] = cutString($one['expert_intro'],26);
				
				$model = new Show();
				$blog_link = $model->createCommendUrl('','home',$one['uid']);
				$expert_list[$id]['blog_link'] = empty($one['blog_link']) ? $blog_link:$one['blog_link'];
			}
		}
		return $expert_list;		
	}	
	
	
	/**
	 * @author: jason
	 * @date: 2010-12-16上午10:50:50
	 * @todo: 获得相册展播
	 * @params:cate_id=6为相册类型
	 */
	public function getAlbumList($limit = 4)
	{
		$cate_id = 6;
		$model = new Show();
		$model->cate_id = $cate_id;
		$cache_key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($cache_key);

		if(!$resource===false)
		{
			return $resource;
		}
			
	
		$relate_arr = $album_list = array();

		
		$rows = $this->getShowList($limit,$cate_id);
		if(!empty($rows))
		{
			foreach ($rows as $value) 
			{
			
				$show_id = $value['id'];
				// 先判断id值不为空
				if(!empty($show_id))
				{
					$relate_arr[] = $show_id;
					$show_arr[$show_id]['icon'] = $value['icon'];
					$show_arr[$show_id]['target_type'] = $value['target_type'];	
				}
			}
		}
		if(!empty($relate_arr))
		{
			$imp_ids = implode(",", $relate_arr);
			
			$connection=Yii::app()->db_uchome;
			$sql = " SELECT * FROM uchome_pic where picid in ($imp_ids) ORDER BY picid  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				foreach ($rows as $value) {
					if(!empty($show_arr[$value['picid']]['icon']))
					{
						$value['icon'] = $show_arr[$value['picid']]['icon'];
					}
					$value['target_type'] = $show_arr[$value['picid']]['target_type'];
					$album_list[$value['picid']] = $value;
				}
			}
			
			foreach($relate_arr as $key=>$id)
			{
				$source[$key] = $album_list[$id]; 
			}
			
			Yii::app()->cache->set($cache_key,$source);
		}
		//array_multisort($relate_arr, SORT_ASC, $source);
		return $source;
			
	}
	
	
	/**
	 * @author: jason
	 * @date: 2010-12-20上午09:48:22
	 * @todo: 获得热门活动
	 * @params:cate_id=8为热门活动,cate_id = 5为精彩活动
	 */
	public function getEventList($limit = 4,$cate_id = 8)
	{
		$model = new Show();
		$model->cate_id = $cate_id;
		$cache_key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($cache_key);

		if(!$resource===false)
		{
			return $resource;
		}
			
		$relate_arr = $event_list = array();
		$rows = $this->getShowList($limit,$cate_id);
		if(!empty($rows))
		{
			foreach ($rows as $value) {
				$show_id = $value['id'];
				// 先判断id值不为空
				if(!empty($show_id))
				{
					$relate_arr[] = $show_id;
					$show_arr[$show_id]['target_type'] = $value['target_type'];	
					$show_arr[$show_id]['description'] = $value['description'];
				}
			}
		}
		
		if(!empty($relate_arr))
		{
			$imp_ids = implode(",", $relate_arr);
			
			$connection=Yii::app()->db_uchome;
			$sql = " SELECT a.*,d.detail FROM uchome_event a 
				LEFT JOIN uchome_eventfield d on a.eventid = d.eventid
				where a.eventid in ($imp_ids) ORDER BY a.eventid  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				foreach ($rows as $value) {
					$value['target_type'] = $show_arr[$value['eventid']]['target_type'];
					$value['description'] = $show_arr[$value['eventid']]['description'];
					$value['name'] = YiicmsUchome::getUchomeRealname($value['uid']);
					$event_list[$value['eventid']] = $value;
				}
			}

			foreach($relate_arr as $key=>$id)
			{
				$source[$key] = $event_list[$id]; 
			}
			
			Yii::app()->cache->set($cache_key,$source);
		}
		//array_multisort($relate_arr, SORT_ASC, $source);
		return $source;
			
	}	

	/**
	 * @author: jason
	 * @date: 2010-12-20上午09:48:22
	 * @todo: 获得热门投票
	 * @params:cate_id=10为投票类型
	 */
	public function getPollList($limit = 4)
	{
		$cate_id = 10;
		
		$model = new Show();
		$model->cate_id = $cate_id;
		$cache_key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($cache_key);

		if(!$resource===false)
		{
			return $resource;
		}
		
			
		$relate_arr = $poll_list = array();
		
		
		$rows = $this->getShowList($limit,$cate_id);
		if(!empty($rows))
		{
			foreach ($rows as $value) {
				$show_id = $value['id'];
				// 先判断id值不为空
				if(!empty($show_id))
					$relate_arr[] = $show_id;
					$show_arr[$show_id]['target_type'] = $value['target_type'];					
			}
		}
		if(!empty($relate_arr))
		{
			$imp_ids = implode(",", $relate_arr);
			
			$connection=Yii::app()->db_uchome;
			$sql = " SELECT a.*,b.option FROM uchome_poll a
				LEFT JOIN uchome_pollfield b on a.pid = b.pid 
				WHERE a.pid in ($imp_ids) ORDER BY a.pid  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				foreach ($rows as $value) {
					$value['target_type'] = $show_arr[$value['pid']]['target_type'];
					$value['option'] = unserialize($value['option']);
					$value['name'] = YiicmsUchome::getUchomeRealname($value['uid']);
					
					$poll_list[$value['pid']] = $value;
					
				}
			}
			foreach($relate_arr as $key=>$id)
			{
				$source[$key] = $poll_list[$id]; 
			}
			
			Yii::app()->cache->set($cache_key,$source);
		}
		//array_multisort($relate_arr, SORT_ASC, $source);
		return $source;
	}		
	
	/**
	 * @author: jason
	 * @date: 2010-12-20上午09:48:22
	 * @todo: 获得热门日志
	 * @params:cate_id=9为日志类型
	 */
	public function getBlogList($limit = 4)
	{
		$cate_id = 9;
		$model = new Show();
		$model->cate_id = $cate_id;
		$cache_key =$model->getShowListCacheKey();
		$resource=Yii::app()->cache->get($cache_key);

		if(!$resource===false)
		{
			return $resource;
		}
	
		$blog_list = $relate_arr = array();
		
		
		$rows = $this->getShowList($limit,$cate_id);
		if(!empty($rows))
		{
			foreach ($rows as $value) {
				$show_id = $value['id'];
				// 先判断id值不为空
				if(!empty($show_id))
					$relate_arr[] = $show_id;
					$show_arr[$show_id]['icon'] = $value['icon'];
					$show_arr[$show_id]['target_type'] = $value['target_type'];
			}
		}
		if(!empty($relate_arr))
		{
			$imp_ids = implode(",", $relate_arr);
			$connection=Yii::app()->db_uchome;
			$sql = " SELECT a.*,b.message FROM uchome_blog a
				LEFT JOIN uchome_blogfield b on a.blogid = b.blogid
				where a.blogid in ($imp_ids) ORDER BY a.blogid  LIMIT {$limit} ";
			$command = $connection->createCommand($sql);
			$rows = $command->queryAll();
			if(!empty($rows))
			{
				foreach ($rows as $value) {
					//if(empty($value['icon'])) $value['icon'] = 'image/nologo.jpg';
					$value['icon'] = $show_arr[$value['blogid']]['icon'];
					$value['target_type'] = $show_arr[$value['blogid']]['target_type'];
					$value['name'] = YiicmsUchome::getUchomeRealname($value['uid']);
					$blog_list[$value['blogid']] = $value;
				}
			}

			foreach($relate_arr as $key=>$id)
			{
				$source[$key] = $blog_list[$id]; 
			}
			
			Yii::app()->cache->set($cache_key,$source);
		}
		//array_multisort($relate_arr, SORT_ASC, $source);
		return $source;
	}		
	/**
	 * @author: jason
	 * @date: 2010-12-16上午11:37:48
	 * @todo: 获得动态信息
	 * @params:
	 */
	public function getFeedList($limit)
	{
		$cache_key = 'IndexGetFeedList';
		$resource=Yii::app()->cache->get($cache_key);
		if(!$resource===false)
		{
			return $resource;
		}
	
		// 暂只获取相册，活动，群组，投票，话题，心情，日志的动态
		$wheresql = "1 AND bb.icon in ('album','blog','click','comment','doing','event','mtag','poll','post','thread','share','wall')";//没有隐私
		$ordersql = "bb.dateline DESC";
		$theurl = "space.php?do=$do&view=all";

		//全站feed
		$feed_list = array();
		
		$connection=Yii::app()->db_uchome;
		$sql = "SELECT * FROM (SELECT * FROM uchome_feed order by dateline DESC limit 200) bb WHERE $wheresql group by uid ORDER BY $ordersql LIMIT {$limit}";
		$command = $connection->createCommand($sql);
		$rows = $command->queryAll();
		

		if(!empty($rows))
		{
			$actors = array();
			$a_value = array();
			foreach ($rows as $value) {
				$actors = "<a href=\"".UCHOME_API."/space.php?uid=$value[uid]\">".$value['username']."</a>";
				$a_value = mkfeed($value, $actors);
				$a_value['name'] =  YiicmsUchome::getUchomeRealname($a_value['uid']);
				$feed_list[] = $a_value;
			}
		}

		$data = array(
			'feed_list'=>$feed_list,
		);
		
		Yii::app()->cache->set($cache_key,$data,60*5);
		
		return $data;
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-29下午02:28:31
	 * @todo: 获得跳转页面类型
	 * @params:
	 */
	public function getTargetTypeList()
	{
		$type_arr = array(
			'_blank'=>'新页面',
			'_self'=>'本页面',
		);
		return $type_arr;
	}
	
	/**
	 * @author: jason
	 * @date: 2010-12-29下午02:28:57
	 * @todo: 获得相册展播所有相片
	 * @params:
	 */
	public function getAlbumPic($id)
	{
		if(empty($id))
			return 0;
		$connection=Yii::app()->db_uchome;
		$sql = " SELECT * FROM uchome_pic where picid = $id ORDER BY picid  LIMIT 1 ";
		$command = $connection->createCommand($sql);
		$rows = $command->queryRow();
		if(!empty($rows))
		{
			$icon = $rows['filepath'];
			return $icon;
		}
		
	}
	
	
	
	
	
}
