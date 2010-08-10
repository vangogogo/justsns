<?php

class User extends CActiveRecord
{
	public $verifyCode;
	public $repassword;
	public $rememberMe;
	public $area;
	public $face;
	public $oldpassword;
	/**
	 * The followings are the available columns in table 'user':
	 * @var integer $id
	 * @var string $email
	 * @var string $password
	 * @var string $username
	 * @var string $handle
	 * @var string $sex
	 * @var string $birthday
	 * @var string $blood_type
	 * @var string $current_province
	 * @var string $current_city
	 * @var string $current_area
	 * @var string $admin_level
	 * @var integer $commend
	 * @var integer $active
	 * @var integer $ctime
	 * @var integer $identity
	 * @var integer $score
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('commend, active, ctime, identity, score', 'numerical', 'integerOnly'=>true),
		array('email, username, handle, birthyear,birthmonth,birthday, current_province, current_city, current_area, admin_level', 'length', 'max'=>255),
			
		array('blood_type', 'length', 'max'=>5),
			
		array('email','email'),
			
		array('password', 'length', 'max'=>50, 'min'=>6, 'on' => 'reg', 'message' => '密码由6-16个英文字母、数字或特殊字符组成'),
		//修改密码
		array('password,repassword,oldpassword','required', 'on' => 'modify'),
		array('password,repassword,oldpassword', 'length', 'max'=>50, 'min'=>6, 'on' => 'modify','message' => '密码由6-16个英文字母、数字或特殊字符组成'),

		//修改email
		array('email,verifyCode','required', 'on' => 'account'),
		//基本资料
		array('username','required', 'on' => 'base'),
			
		array('password,repassword,email,username,sex,verifyCode,area','required', 'on' => 'reg'),
		array('username', 'checkUsername', 'on'=> 'account,reg'),
		array('email', 'checkEmail', 'on'=> 'account,reg'),
		array('repassword', 'compare', 'compareAttribute'=>'password', 'on' => 'reg,modify','message' => '两次输入的密码不一样，请重输！'),
			
		array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd'), 'on' => 'account,reg'),
			
		//ajax验证
		array('username', 'application.extensions.jformvalidate.ECustomJsValidator' ,
				'rules'	=> array(
					'remote' => Yii::app()->createUrl('/site/checkUsername'),
		),
				'messages' => array(
					'remote' => '{attribute} already exist'
					)
					),
					array('email', 'application.extensions.jformvalidate.ECustomJsValidator' ,
				'rules'	=> array(
					'remote' => Yii::app()->createUrl('/site/checkEmail'),
					),
				'messages' => array(
					'remote' => '{attribute} already exist'
					)
					),
					);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'mini'=>array(self::HAS_ONE, 'Mini', 'uid', 'order' => 'mini.ctime DESC'),
			'apps'=>array(self::MANY_MANY, 'App', 'app_user(appid,uid)','order'=>'appid '),
		);
	}

	public function getBloodTypes()
	{
		return array(
			'O型' => 'O型',
			'A型' => 'A型',
			'B型' => 'B型',
			'AB型' => 'AB型',
			'稀有血型' => '稀有血型'
			);

	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'email' => 'Email',
			'password' => '密码',
			'username' => '用户名',
			'handle' => 'Handle',
			'sex' => '性别',
			'birthyear' => '年份',
			'birthmonth' => '月份',
			'birthday' => '生日',
			'blood_type' => '血型',
			'current_province' => '省份',
			'current_city' => '城市',
			'current_area' => '地区',
			'admin_level' => 'Admin Level',
			'commend' => 'Commend',
			'active' => 'Active',
			'ctime' => 'Ctime',
			'identity' => 'Identity',
			'score' => 'Score',
			
			'verifyCode' => '验证码',
			'repassword' => '重复密码',
			'rememberMe' => '记住密码',
			'oldpassword' => '旧密码',
			'area' => '居住地址',
		);
	}

	/**
	 * 保存密码前md5
	 */
	public function beforeSave()
	{
		$this->password = md5($this->password);
		return true;
	}
	
	public function afterFind()
	{
		$this->face = $this->getUserFace();
	}
	/**
	 * 检查用户名是否存在
	 */
	public function checkUsername() {
		if(Yii::app()->user->name == $this->username) return true;
		$user = self::model();
		$error_msg = 'username already exist';

		if($user->count('username=:username', array(':username'=>$this->username)) > 0) {
			$this->addError('email',$error_msg);
			return false;
		}
		else
		{
			return true;
		}
	}

	public function getSpaceUrl($name = '',$title = '')
	{
		$uid = $this->id;
		$url = Yii::app()->createUrl('/space/',array('uid'=>$uid));
		return $url;
	}
	
	public function getSpaceUrlWithName($showface = 0)
	{
		$user = $this;
		$uid = $user->id;
		$username = $user->getUserName();
		if($showface == 1)
		{
			$src = $user->getUserFace();
			$name = CHtml::image($src,$username);
		}
		else
		{
			$name = $username;
		}
		$url = CHtml::link($name,array('/space','uid'=>$uid),array('title'=>$username));

		return $url;
	}
	
	public function getSpaceUrlWithFace($showTip = 0)
	{

		$url = $this->getSpaceUrlWithName(1);
		$html = '<span class="headpic50">';
		$html .= $url;
		$html .= '</span>';

		return $html;
	}
	/**
	 * 检查邮箱是否存在
	 */
	public function checkEmail() {
		$user = self::model();
		$error_msg = 'email already exist';
		if($user->count('email=:email', array(':email'=>$this->email)) > 0) {
			$this->addError('email',$error_msg);
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * 刷新在线时间
	 */
	public function refreshOnline()
	{
		$model = new UserOnline();
			
		$uid = Yii::app()->user->id;
		$condition = 'uid='.$uid;
		$count = $model->count($condition);

		if($count>0){
			$attribute = array(
				'activeTime'=> time()
			);
			$model = $model->find($condition);
			$model->attributes = $attribute;
			$model->save();
		}else{
			$attribute = array(
				'uid' => Yii::app()->user->id,
				'username' => Yii::app()->user->name,
				'activeTime'=> time()
			);
			$model->attributes = $attribute;
			$model->save();
		}
	}

	/**
	 * 获得用户心情
	 */
	public function getUserMini()
	{
		$model = new Mini();
		$uid = $this->id;
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>$uid);

		$mini = $model->find($criteria);
		return $mini['content'];
	}

	/**
	 * 获得用户头像
	 */
	public function getUserFace($uid = '',$size = 'middle')
	{
		$size = in_array($size, array('big', 'middle', 'small',"yuan")) ? $size : 'middle';
		if(empty($uid))
		$uid = $this->id;
		$path = Yii::app()->params['uploadPath'].'userface/';
		$image = $path.$uid.'_'.$size.'_face.jpg';

		if(!file_exists($image)) {
			//男或女
			//$info =  $api->user_getInfo($uid,"sex");
			$info = $this->attributes;
			if( !$info['sex'] ) {
				return Yii::app()->theme->baseUrl."/images/pic2.gif";
			}else {
				return Yii::app()->theme->baseUrl."/images/pic1.gif";
			}

		}else {
			$url = Yii::app()->params['upload_dir'].'userface/';
				
			$image = $url.$uid.'_'.$size.'_face.jpg';
			return $image;
		}
	}

	public function getUserInfo()
	{
		$arr = $this->attributes;
		$arr['mini'] = $this->getUserMini();
		$arr['face'] = $this->getUserFace();
		return $arr;
	}

	public function getUserWo()
	{
		$sex = $this->sex;
		$sex = explode("-",$info['sex']);
		return $sex[0] ? "他":"她";

	}

	public function getUserName($uid = '')
	{
		if(!empty($this->username))
		{
			$user = $this;
		}
		else
		{
			$user = User::model()->findByPk($uid);
		}

		return $user->username;
	}

	public function getUserGroupIcon()
	{
		$GroupIcon = 'UserGroupIcon';
		return $GroupIcon;
	}

	public function getUserApps($num = '')
	{
		$model = new App();
		$criteria = new CDbCriteria;
		if(!empty($num))
		{
			$criteria->limit = $num;
		}
		return $this->apps;
	}

	public function getUserFriends($uid) {
		$friends = array();

		$model = new Friend();
		//初始化
		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->condition="t.uid=:uid";
		$criteria->params=array(':uid'=>$uid);
		$criteria->limit = 9;
		//获取数据集
		$friend_list = $model->with('user')->findAll($criteria);
		//好友信息,获取好友记录等等
		$friends = array();
		if(!empty($friend_list))
		{
			foreach($friend_list as $key => $value)
			{
				$fri_user = $value->user;
				if(!empty($fri_user))
				$friends[$key] = $fri_user->getUserInfo();
			}
		}
		return $friends;
	}
	
	
	public function getUserFriendGroups()
	{
		
		//初始化
		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->condition="uid=0 OR uid=:uid";
		$criteria->params=array(':uid'=>Yii::app()->user->id);

		$model = new FriendGroup();
		$groups = $model->findAll($criteria);
		
		return $groups;
	}
	
	
}
