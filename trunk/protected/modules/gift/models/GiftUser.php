<?php

/**
 * This is the model class for table "{{gift_user}}".
 *
 * The followings are the available columns in table '{{gift_user}}':
 * @property integer $id
 * @property integer $fromUserId
 * @property integer $toUserId
 * @property string $username
 * @property integer $toGroupID
 * @property integer $gift
 * @property string $content
 * @property integer $access
 * @property integer $ctime
 */
class GiftUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GiftUser the static model class
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
		return '{{gift_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromUserId, toUserId, fromUsername, toUsername, giftId, ctime', 'required'),
			array('fromUserId, toUserId, toGroupID, giftId, access, ctime', 'numerical', 'integerOnly'=>true),
			array('fromUsername', 'length', 'max'=>50),
			array('content', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fromUserId, toUserId, fromUsername, toUsername, toGroupID, giftId, content, access, ctime', 'safe', 'on'=>'search'),
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
			'sender'=>array(self::BELONGS_TO, 'User', 'fromUserId'),
			'reciver'=>array(self::BELONGS_TO, 'User', 'toUserId'),
			'gift'=>array(self::BELONGS_TO, 'Gift', 'giftId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'fromUserId' => '发送者id',
			'toUserId' => '接受者id',
			'fromUsername' => '发送者名',
			'toUsername' => '接收者名',
			'toGroupID' => '接受者群id',
			'giftId' => '礼物',
			'content' => '附言',
			'access' => '赠送的方式',
			'ctime' => '发送时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('fromUserId',$this->fromUserId);

		$criteria->compare('toUserId',$this->toUserId);

		$criteria->compare('fromUsername',$this->fromUsername,true);
		
		$criteria->compare('toUsername',$this->toUsername,true);

		$criteria->compare('toGroupID',$this->toGroupID);

		$criteria->compare('giftId',$this->giftId);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('access',$this->access);

		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider('GiftUser', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->fromUserId=Yii::app()->user->id;
			$this->fromUsername = Yii::app()->user->name;
			$this->ctime=time();
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