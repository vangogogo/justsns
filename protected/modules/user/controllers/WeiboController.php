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
			$this->redirect('atme');
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
        arsort($user_count_list);

        if(!empty($user_count_list))
        {
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

        }
        $random_text = $this->getRandomText();

        $data = array(
            'user_list'=>$user_list,
            'user_count_list'=>$user_count_list,
            'sex_count'=>$sex_count,
            'weibo_count'=>$weibo_count,
            'message'=>$message,
            'random_text'=>$random_text,
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
}
