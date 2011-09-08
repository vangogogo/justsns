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

	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
                'actions'=>array('index','sms','SendTeacherDaySms'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
                'actions'=>array('login'),
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
			$this->redirect('weibo');
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
        $sina_info = $client->show_user($sina_id);
        print_r($sina_info);
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
                $user_list[$uid] = $user;
                $user_count_list[$uid] ++;
            }
        }
        arsort($user_count_list);

        if(!empty($user_count_list))
        {
            foreach($user_count_list as $uid => $count)
            {
                if($count <=3 OR $uid == $sina_id)
                    unset($user_count_list[$uid]);                
            }
        }

        if(!empty($user_count_list))
        {
            foreach($user_count_list as $uid => $count)
            {
                $user = $user_list[$uid];
                $sex_count[$user['gender']]++;
            }
        }
        //统计
        
        
        print_r($sex_count);


        $data = array(
            'user_list'=>$user_list,
            'user_count_list'=>$user_count_list,
            'sex_count'=>$sex_count,
        );

		$this->render('atme',$data);
    }
}
