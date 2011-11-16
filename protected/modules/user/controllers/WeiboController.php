<?php

class WeiboController extends Controller
{
	public $defaultAction = 'index';

    public $layout = 'user.views.weibo.layout_weibo';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}


	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',  // deny all users
				'users'=>array('*'),
                'actions'=>array('login','callback'),
			),
			//已经登录用户不允许访问 登录页面与注册页面
			array('deny', // allow authenticated users to access all actions
				'actions'=>array('login','signup'),
				'users'=>array('@'),
			),
			//非登录用户 不允许访问退出页面
			array('deny',  // deny all users
				'users'=>array('guest'),
                'actions'=>array('index'),
			),
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
        $this->checkAuthorize();
		
		$aurl = $SAEOAuth->getAuthorizeURL();
		$this->redirect($aurl);
	}
	/**
	 * Displays the login page
	 */
	public function actionCallback()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
		$SAEOAuth->callback();
        $this->checkAuthorize();
	}
	/**
	 * 检查是否登录weibo
	 */
    public function checkAuthorize()
    {
		$SAEOAuth = Yii::app()->SAEOAuth;
		if($SAEOAuth->checkAuthorize())
		{
            $model = new WeiboForm;
            $model->loginBySina();
			$this->redirect('index');
		}
    }
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
        $this->pageTitle = '我的微薄';
		$SAEOAuth = Yii::app()->SAEOAuth;
		$client = $SAEOAuth->getSinaClient();

        $sina_id = $SAEOAuth->getUserID();
        if(empty($sina_id))
        {
           $this->actionLogin(); 
        }
        $sina_info = $client->show_user($sina_id);

        $data = array(
            'sina_info'=>$sina_info,
        );

		$this->render('weibo',$data);
	}

    public function actionAtme()
    {

        $this->pageTitle = '最爱@我';
		$SAEOAuth = Yii::app()->SAEOAuth;
		$client = $SAEOAuth->getSinaClient();

        $sina_id = $SAEOAuth->getUserID();
        if(empty($sina_id))
        {
           $this->actionLogin(); 
        }

        $sina_info = $client->show_user($sina_id);
        #print_r($sina_info);
        $count = 200;
        $page = 1;
        $ms = array();
        while($tmp<=1)
        {
            $tmp = $client->mentions($page,$count);
            $ms += $tmp;
            $tmp_count = count($tmp);
            $page ++;
        }
        $sum = count($ms);

        if(!empty($ms))
        {
            foreach($ms as $one)
            {
                $user = $one['user'];
                $uid = $user['id'];
                if($uid == $sina_id)
                    continue;
                $user_list[$uid] = $user;
                $user_count_list[$uid] ++;
            }
        }


        if(!empty($user_count_list))
        {
            arsort($user_count_list);
            $size = 10;

            $tmp = array_chunk($user_count_list,$size,true);
            $user_count_list = $tmp[0];
        }

        if(!empty($user_count_list))
        {
            foreach($user_count_list as $uid => $count)
            {
                $user = $user_list[$uid];
                $sex_count[$user['gender']]++;
                $weibo_count[$user['gender']]+=$count;
            }
        }

        //统计
        if(!empty($sex_count))
        {
            $gender = $sina_info['gender'];
            $gender_other = $sina_info['gender']=='m'?'f':'m';
            
            //比例
            $gender_persent = 100*$sex_count[$gender]/($sex_count[$gender]+$sex_count[$gender_other]);
        }
        $message = $this->getPersentMessage($gender_persent);
        $random_text = $this->getRandomText();

		if(count($user_count_list)>=3)
		{
			foreach($user_count_list as $uid =>$count)
			{
				$user = $user_list[$uid];
				$text_arr[] = $user['name'];
				if(count($img_arr) <3)
				{
					$img_arr[] = array(
                        'img_url' => $user['profile_image_url'],
                        'name' => $user['name'],
                    );

					$ids_arr[] = $uid;
					//微博内容
					$send_weibo_text .= "@{$user[name]} ";
				}
				else
				{
					$text_arr_other[] = $user['name'];
				}
			}

            include('saedisk.class.php');
            $SaeDisk = new SaeDisk();
		    $file_name = "atme_{$ids_arr[0]}_{$ids_arr[1]}_{$ids_arr[2]}";


			if($SaeDisk->file_exists($file_name))
			{
				$weibo_img = $SaeDisk->getWebUrl($file_name);
			}
			else
			{

			    Yii::import('application.extensions.image.Image');

                $app_root = Yii::getPathOfAlias('webroot');
                
			    $atme_img = $app_root.'/images/atme.jpg';
                $image_base = new Image($atme_img);

			    //实例化SaeImage并取得最大一张图片的大小，稍后用于设定合成后图片的画布大小

                $tmp_path = Yii::app()->runtimePath;

                //写入临时文件
                if(!empty($image_base))
                {

                    $new_filename = $tmp_path.'/'.$file_name;

                    $image_base->save($new_filename);

                    if(!empty($img_arr))
                    {
                        $img_zuobiao = array(
                            '0'=>array('left'=>188,'top'=>53),
                            '1'=>array('left'=>304,'top'=>106),
                            '2'=>array('left'=>64,'top'=>138),
                        );
                        $text_zuobiao = array(
                            '0'=>array('left'=>180,'top'=>40),
                            '1'=>array('left'=>300,'top'=>98),
                            '2'=>array('left'=>64,'top'=>128),
                        );
                        
                        $textAttr = array(
                            "fontName"=>SAE_Font_MicroHei, "fontSize"=>12,  "fontColor"=>"#333333"
                        );

                        foreach($img_arr as $key => $one)
                        {
                            $name = $one['name'];
                            $img_url = $one['img_url'];


                            $img_data = file_get_contents($img_url);
                            $img_filename = $tmp_path.'/'.md5($img_url);

                            $avatra[] = file_put_contents($img_filename,$img_data);

                            //头像
                            $image_avatra = new Image($img_filename);
                            $zuobiao = $img_zuobiao[$key];
                            $left = $zuobiao['left'];
                            $top = $zuobiao['top'];
                            $image_base->watermark($image_avatra,100,$left,$top);


                            $zuobiao2 = $text_zuobiao[$key];

                            $image_base->watermarkText($name,100,$zuobiao2['left'],$zuobiao2['top'],$textAttr);
                            #$image_base->save($new_filename);

                            //文字
                            #$image_name = ImageCreateFromString($name);
                            #ImagePng($image_name);
                            #ImagePng($image,$outfilename);

                        }
                    }

                    $image_base->save($new_filename);
                    $image_base = new Image($new_filename);

                    $weibo_img = $SaeDisk->upload_file($file_name,$image_base->file,$attr);

                }
			}




			//转发到微博
			if(!empty($_GET['sendWeibo']))
			{
				unset($_GET['sendWeibo']);
				$status = "最爱at我的前三名是：{$send_weibo_text} 谢谢关心和支持！";
				$length1 = mb_strlen($status,'UTF8');
				#$status .= ">> 偷偷告诉你们:".$random_text;
				$goto_url = "看看你的：http://t.cn/aB795y";
				$length2 = mb_strlen($goto_url,'UTF8');

				$length_other = 140 - $length1 - $length2;
				if(!empty($text_arr_other))
				{
					foreach($text_arr_other as $name)
					{
						$length_name = mb_strlen($name,'UTF8');
						$length = mb_strlen($send_weibo_text_other,'UTF8');

						if($length+$length_name > $length_other)
						{
							break;
						}
						$send_weibo_text_other .= "@{$name} ";
					}
				}

				$status = $status.$send_weibo_text_other.$goto_url;

				$count = mb_strlen($status,'UTF8');
				#var_dump($count);
				#var_dump($status);die;
				$rs = $client->upload( $status , $weibo_img);
				Yii::app()->user->setFlash('sendWeibo','转发成功了亲！');
				$this->redirect('/user/weibo/atme');
			}
		}
        $data = array(
            'user_list'=>$user_list,
            'user_count_list'=>$user_count_list,
            'sex_count'=>$sex_count,
            'weibo_count'=>$weibo_count,
            'message'=>$message,
            'random_text'=>$random_text,
			'weibo_img'=>$weibo_img,
        );

		$this->render('atme',$data);
    }

    public function getRandomText()
    {
        $num = rand(1,33);
        $arr = array(
            1=>'距离产生美',
            2=>'你让我也让，心宽路更宽',
            3=>'人与人近点，车与车远点',
            4=>'保护新手，人人有责',
            5=>'碰撞十次，九胜一平',
            6=>'菜鸟上路，请多关照',
            7=>'移动障碍物，请绕行',
            8=>'手潮心乱，越催越慢',
            9=>'新手初驾，擅长急刹',
            10=>'只有你在后面默默支持我',
            11=>'最远的你是我最近的爱',
            12=>'车外不要吻我，车内禁止接吻',
            13=>'大修没钱，欢迎追尾',
            14=>'车新人老，眼神不好；左摇右晃，急刹不住',
            15=>'事故多发车辆，请绕行',
            16=>'买的证，租的车，您看着办',
            17=>'新手旧车，都不太灵',
            18=>'驾校除名，自学成才',
            19=>'就是面，正在练',
            20=>'10年驾龄，安全行驶100公里',
            21=>'“新潮面”＝新手＋手潮＋特面',
            22=>'路考五次不及格',
            23=>'核弹后置，保持距离',
            24=>'不是碰碰车',
            25=>'年龄60岁，驾龄60天',
            26=>'注意，前方有交警',
            27=>'昨天领证，正高兴ing…',
            28=>'高龄新手，大修磨合',
            29=>'超级大面包，新鲜出炉',
            30=>'驾照第一天，我面故我慢',
            31=>'马路杀手培训班新近毕业',
            32=>'泰森正在车上睡觉',
            33=>'刚买的本！'
        );
        return $arr[$num];
    }

    public function getPersentMessage($gender_persent = 0)
    {
        switch($gender_persent)
        {
            case $gender_persent <= 0:
                $message = "你无敌了！ 只有异性对你有兴趣啊";
                break;

            case $gender_persent <= 20:
                $message = "看来你的异性缘比较好，有木有！！！！";
                break;
            case $gender_persent <= 30:
                $message = "看来你的异性缘比较好，有木有！！！！";
                break;
            case $gender_persent <= 50:
                $message = "五十五十，不偏不倚！ 你是男女通杀呢还是男女通杀呢？ ";
                break;
            case $gender_persent <= 90:
                $message = "铁血真汉子还是柔弱软妹子呢";
                break;
        }
        return $message;
    }

	public function actionSendWeibo()
	{
		$SAEOAuth = Yii::app()->SAEOAuth;
		$client = $SAEOAuth->getSinaClient();

        $sina_id = $SAEOAuth->getUserID();
        if(empty($sina_id))
        {
           $this->actionLogin(); 
        }

        $client->upload( $status , $pic_path);


	}
}
