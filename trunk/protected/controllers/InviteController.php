<?php

class InviteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->pageTitle = '邀请好友';
		$model=new User();
		$uid = Yii::app()->user->id;
		$form = $model->findByPk($uid);
		$form->scenario = 'base';
		$data = array(
			'form' => $form,
		);
		$this->render('index',$data);
	}

	public function actionPostOffice()
	{

	}

	//导入邮件地址薄
	public function postOffice(){
		$this->display();
	}


	public function getEmailList(){
		set_time_limit(0);

		if(empty($_POST['account']) || empty($_POST['password'])){
			$this->error('账号或者密码不能为空');
		}
		vendor('Sync.mailfactory');
		switch ($_POST['email_type']){
			case "126.com":
				$contact = new MailFactory(M126);
				break;
			case "sina.com":
				$contact = new MailFactory(MSINA);
				break;
			case "tom.com":
				$contact = new MailFactory(MTOM);
				break;
			case "gmail.com":
				$contact = new MailFactory(MGOOGLE);
				break;
			case "163.com":
				$contact = new MailFactory(M163);
				break;
			case "sohu.com":
				$_POST['account'] = $_POST['account'] . "@" . $_POST['email_type'];
				$contact = new MailFactory(MSOHU);
				break;
			case "vip.sohu.com":
				$_POST['account'] = $_POST['account'] . "@" . $_POST['email_type'];
				$contact = new MailFactory(MSOHU_VIP);
				break;
			case "yahoo.cn":
			case "yahoo.com":
			case "yahoo.com.cn":
				$_POST['account'] = $_POST['account'] . "@" . $_POST['email_type'];
				$contact = new MailFactory(MYAHOO);
				break;
			default:
				die("error");
		}
		$contacts = $contact->getcontactlist($_POST['account'], $_POST['password']);

		if(empty($contacts)){
			$this->error('对不起，没有找到你的联系人');
		}else{
			$emailArr = D('Invite')->filterEmail($contacts,$this->mid);

			//获取朋友类型
			$map = "uid = 0 or uid = ".$this->mid;
			$groups = D("FriendGroup")->where($map)->order("id asc")->findAll();

			$this->assign("groups",$groups);
			$this->assign('emailArr',$emailArr);
			$this->display('doMsnInvite');
		}
	}
}
