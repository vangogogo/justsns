<?php

/**
 * This is the model class for table "{{gift_user}}".
 *
 * The followings are the available columns in table '{{gift_user}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $touid
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
			array('uid, touid, username, gift, content, ctime', 'required'),
			array('uid, touid, toGroupID, gift, access, ctime', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('content', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, touid, username, toGroupID, gift, content, access, ctime', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'uid' => '发送者id',
			'touid' => '接受者id',
			'username' => '发送者名',
			'toGroupID' => '接受者群id',
			'gift' => '礼物',
			'content' => '附言',
			'access' => '赠送的方式',
			'ctime' => '时间',
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

		$criteria->compare('uid',$this->uid);

		$criteria->compare('touid',$this->touid);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('toGroupID',$this->toGroupID);

		$criteria->compare('gift',$this->gift);

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