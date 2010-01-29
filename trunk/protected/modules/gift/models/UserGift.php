<?php

class UserGift extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'user_greeting':
	 * @var integer $id
	 * @var integer $uid
	 * @var integer $toUserid
	 * @var string $fromUserName
	 * @var integer $toGroupID
	 * @var integer $greetingid
	 * @var integer $greatingContent
	 * @var integer $greatingAccess
	 * @var integer $cTime
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
		return 'user_gift';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, toUserid, fromUserName, greetingid, greatingContent, greatingAccess, cTime', 'required'),
			array('uid, toUserid, toGroupID, greetingid, greatingAccess, cTime', 'numerical', 'integerOnly'=>true),
			array('fromUserName', 'length', 'max'=>50),
			array('greatingContent', 'length', 'max'=>255),
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
			//greeting
			'greeting'=>array(self::BELONGS_TO, 'Greeting', 'greetingid'),
			
			//user
			'sender'=>array(self::BELONGS_TO, 'user', 'uid'),
			'revicer'=>array(self::BELONGS_TO, 'user', 'toUserid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'uid' => '发送者id',
			'fromUserName' => '发送者名',
			'toUserid' => '接受者id',
			'toGroupID' => '接受者群id',
			'greetingid' => '问候id',
			'greatingContent' => '附言',
			'greatingAccess' => '赠送的方式',
			'cTime' => '时间',
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
			$this->fromUserName = Yii::app()->user->name;
			$this->cTime=time();
		}
		
		return true;
	}
	
	/**
	 * @return 返回问候类型
	 */
	public function getAccessOptions()
	{
		return array(
			0 => '公开赠送',
			1 => '私下赠送',
			2 => '匿名赠送',
		);
	}
	
	/**
	 * 添加提示
	 */
	protected function afterSave() 
	{
		if($this->isNewRecord)
		{
			//创建时发送通知作为提示？
		}
		else 
		{

		}
	}
		
}