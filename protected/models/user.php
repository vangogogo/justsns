<?php

class user extends CActiveRecord
{
	public $verifyCode;
	public $repassword;
	public $rememberMe;
	public $area;
	
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
		return 'user';
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
			
			array('password', 'length', 'max'=>50, 'min'=>6, 'on' => 'reg'),
			//修改密码
			array('password,repassword,oldpassword','required', 'on' => 'modify'),
			array('password,repassword,oldpassword', 'length', 'max'=>50, 'min'=>6, 'on' => 'modify'),
			//修改email
			array('email,verifyCode','required', 'on' => 'account'),
			//基本资料
			array('username','required', 'on' => 'base'),
			
			array('password,repassword,email,username,sex,verifyCode,area','required', 'on' => 'reg'),
			array('username', 'checkUsername'),
			array('email', 'checkEmail'),
			array('repassword', 'compare', 'compareAttribute'=>'password', 'on' => 'reg,modify','message' => '两次输入的密码不一样，请重输！'),
		    array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		    
		    //ajax验证
			array('username', 'application.extensions.jformvalidate.ECustomJsValidator' ,
				'rules'    => array(
					'remote' => Yii::app()->createUrl('/site/checkUsername'),
				),
				'messages' => array(
					'remote' => '{attribute} already exist'
				)
			),
			array('email', 'application.extensions.jformvalidate.ECustomJsValidator' ,
				'rules'    => array(
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
	public function beforeSave() {
		$this->password = md5($this->password);
		return true;
	}
	
	/**
	 * 检查用户名是否存在
	 */
	public function checkUsername() {
		$user = self::model();
		$error_msg = '';
		if($user->count('username=:username', array(':username'=>$this->username)) > 0) {
			$error_msg = 'username already exist';
			$this->addError('email',$error_msg);
			return false;
		}
		else 
		{
			return true;
		}

		
	}
	
	/**
	 * 检查邮箱是否存在
	 */
	public function checkEmail() {
		$user = self::model();
		if($user->count('email=:email', array(':email'=>$this->email)) > 0) {
			$error_msg = 'email already exist';
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
		$mini = '天天好心情';
		return $mini;
	}
	
	/**
	 * 获得用户头像
	 */	
	public function getUserFace($uid,$type = 'small')
	{
		if(empty($uid))
			$uid = $this->id;
		return $mini;
	}		
}
