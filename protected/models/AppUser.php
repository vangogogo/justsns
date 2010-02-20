<?php

class AppUser extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'app_user':
	 * @var integer $appid
	 * @var integer $uid
	 * @var integer $open
	 * @var integer $publish_to_profile
	 * @var integer $activited
	 * @var integer $login_times
	 * @var integer $last_login_time
	 * @var integer $invitor
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
		return 'app_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appid, uid, open, publish_to_profile, activited, login_times, last_login_time, invitor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('appid, uid, open, publish_to_profile, activited, login_times, last_login_time, invitor', 'safe', 'on'=>'search'),
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
			'appid' => 'Appid',
			'uid' => 'Uid',
			'open' => 'Open',
			'publish_to_profile' => 'Publish To Profile',
			'activited' => 'Activited',
			'login_times' => 'Login Times',
			'last_login_time' => 'Last Login Time',
			'invitor' => 'Invitor',
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

		$criteria->compare('appid',$this->appid);

		$criteria->compare('uid',$this->uid);

		$criteria->compare('open',$this->open);

		$criteria->compare('publish_to_profile',$this->publish_to_profile);

		$criteria->compare('activited',$this->activited);

		$criteria->compare('login_times',$this->login_times);

		$criteria->compare('last_login_time',$this->last_login_time);

		$criteria->compare('invitor',$this->invitor);

		return new CActiveDataProvider('AppUser', array(
			'criteria'=>$criteria,
		));
	}
}