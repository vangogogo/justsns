<?php

class LoginRecord extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'login_record':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $login_ip
	 * @var integer $login_time
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
		return '{{login_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, login_time', 'numerical', 'integerOnly'=>true),
			array('login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, login_ip, login_time', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'login_ip' => 'Login Ip',
			'login_time' => 'Login Time',
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

		if($this->id!='')
		{
			$criteria->addCondition('id=:id');
			$criteria->params[':id']=$this->id;
		}
		if($this->uid!='')
		{
			$criteria->addCondition('uid=:uid');
			$criteria->params[':uid']=$this->uid;
		}
		if($this->login_ip!='')
			$criteria->addSearchCondition('login_ip',$this->login_ip);

		if($this->login_time!='')
		{
			$criteria->addCondition('login_time=:login_time');
			$criteria->params[':login_time']=$this->login_time;
		}
		return new CActiveDataProvider('LoginRecord', array(
			'criteria'=>$criteria,
		));
	}
}