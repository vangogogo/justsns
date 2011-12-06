<?php

class SNSUser extends YiicmsActiveRecord
{

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

	public function getSpaceUrl($uid = '')
	{
		if(empty($uid))
		{
			$uid = $this->primaryKey;
		}
		$url = Yii::app()->createUrl('/space/index',array('uid'=>$uid));
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
		$url = CHtml::link($name,array('/space/index','uid'=>$uid),array('title'=>$username));

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
		$mini = $this->profile->mini;
		$smile = new Smile();
		$mini =  $smile->replaceContent($mini);
        return $mini;

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
			if( !empty($info['sex']) ) {
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
        $username = $user->profile->name;
        if(empty($username))
        {
            $username = $user->username;
        }
		return $username;
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
