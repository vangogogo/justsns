<?php

class Friend extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'friend':
	 * @var integer $uid
	 * @var integer $fuid
	 * @var string $fusername
	 * @var integer $status
	 * @var string $note
	 * @var integer $dateline
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
		return 'friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, fuid, status, dateline', 'numerical', 'integerOnly'=>true),
			array('fusername', 'length', 'max'=>15),
			array('note', 'length', 'max'=>50),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$fbg = FriendBelongGroup::model()->tableName() ;
		return array(
			'user'=>array(self::BELONGS_TO, 'user', 'fuid'),
			'group' => array(self::HAS_MANY, 'FriendBelongGroup', 'uid', 
				'condition'=>'group.gid=:gid AND group.fuid=friend.fuid', 
				'joinType'=>'INNER JOIN',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => '用户id',
			'fuid' => '好友id',
			'fusername' => '好友名',
			'status' => '状态',
			'note' => '备注',
			'dateline' => '创建时间',
		);
	}
	
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->uid=Yii::app()->user->id;
			$this->dateline=time();
			$user = User::model()->findByPk($this->fuid);
			if(empty($user))
			{
				//提示没有这个用户
			}
			else
			{
				$this->fusername = $user->username;
			}
			$this->status = 0;
		}
		return true;
	}
		
	/**
	 * 好友添加
	 */
	protected function afterSave() 
	{
		if($this->isNewRecord)
		{
			//创建时state = 0，并且发送feed到fuid作为提示
		}
		else 
		{
			//确认好友，state = 1，并自动添加对应的数据
		}
	}
	
	/**
	 * 好友删除，从好友表中删除两条记录，删除好友分组中2个人的关系
	 */
	protected function afterDelete() 
	{
		$condition = "(uid = {$this->uid} AND fuid = {$this->fuid}) OR (uid = {$this->fuid} AND fuid = {$this->uid})";
		//从好友表中删除两条记录		
		Friend::model()->deleteAll($condition);
		//删除好友分组中2个人的关系
		FriendBelongGroup::model()->deleteAll($condition);
	}
		
	/**
	 * 状态检查
	 */	
	public function checkFriendStatus($uid,$fuid)
	{
		$attributes = array(
			'uid' => $uid,
			'fuid' => $fuid,
		);
		$friend = Friend::model()->findByAttributes($attributes);

		$status = '';
		if(!empty($friend))
		{
			$status = $friend->status;
		}
		return $status;
	}
	
	/**
	 * 好友数
	 */	
	public function getFriendNumber($uid = '',$gid = 0)
	{
		if(empty($uid))
		{
			$uid = Yii::app()->user->id;
		}
		$criteria=new CDbCriteria;
		$criteria->condition = 'uid=:uid ';
		$criteria->params = array(':uid'=>$uid);
		if(empty($gid))
		{
			$criteria->addCondition('status= 1');
			$count = Friend::model()->count($criteria);
		}
		else
		{
			$criteria->addCondition('gid='.$gid);
			$count = FriendBelongGroup::model()->count($criteria);
		}


		return $count;
	}	
}
