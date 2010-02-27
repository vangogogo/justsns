<?php

class Feed extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'feed':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $username
	 * @var string $type
	 * @var string $title_data
	 * @var string $body_data
	 * @var integer $cTime
	 * @var string $appid
	 * @var integer $feedtype
	 * @var integer $fid
	 * @var string $cache
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
		return 'feed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, cTime, feedtype, fid', 'numerical', 'integerOnly'=>true),
			array('username, type', 'length', 'max'=>255),
			array('appid', 'length', 'max'=>25),
			array('title_data, body_data, cache', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, username, type, title_data, body_data, cTime, appid, feedtype, fid, cache', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'type' => 'Type',
			'title_data' => 'Title Data',
			'body_data' => 'Body Data',
			'cTime' => 'C Time',
			'appid' => 'Appid',
			'feedtype' => 'Feedtype',
			'fid' => 'Fid',
			'cache' => 'Cache',
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

		$criteria->compare('username',$this->username,true);

		$criteria->compare('type',$this->type,true);

		$criteria->compare('title_data',$this->title_data,true);

		$criteria->compare('body_data',$this->body_data,true);

		$criteria->compare('cTime',$this->cTime);

		$criteria->compare('appid',$this->appid,true);

		$criteria->compare('feedtype',$this->feedtype);

		$criteria->compare('fid',$this->fid);

		$criteria->compare('cache',$this->cache,true);

		return new CActiveDataProvider('Feed', array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFeeds($uid = '',$type = '',$page = 1,$opts)
	{
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->limit = 9;
		if(!empty($uid))
		{
			$condition = 't.uid = '.$uid;
			$criteria->addCondition($condition);
		}
		if(!empty($type))
		{
			$condition = 't.type = '.$type;
			$criteria->addCondition($condition);
		}
		
		$feeds = $this->find($criteria);
		return $feeds;
	}
}