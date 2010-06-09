<?php

class Notify extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'notify':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $type
	 * @var integer $new
	 * @var integer $authorid
	 * @var string $author
	 * @var string $title
	 * @var string $body
	 * @var string $url
	 * @var integer $ctime
	 * @var string $cate
	 * @var integer $appid
	 */
	public $type_arr = array(
		'all' => '全部通知',
		'system' => '系统通知',
		'friend' => '好友请求',
		'app' => '应用通知',
	);
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
		return '{{notify}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, new, authorid, ctime, appid', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>25),
			array('author, cate', 'length', 'max'=>255),
			array('title, body, url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, type, new, authorid, author, title, body, url, ctime, cate, appid', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'new' => 'New',
			'authorid' => 'Authorid',
			'author' => 'Author',
			'title' => 'Title',
			'body' => 'Body',
			'url' => 'Url',
			'ctime' => 'Ctime',
			'cate' => 'Cate',
			'appid' => 'Appid',
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

		$criteria->compare('type',$this->type,true);

		$criteria->compare('new',$this->new);

		$criteria->compare('authorid',$this->authorid);

		$criteria->compare('author',$this->author,true);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('body',$this->body,true);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('cate',$this->cate,true);

		$criteria->compare('appid',$this->appid);

		return new CActiveDataProvider('Notify', array(
			'criteria'=>$criteria,
		));
	}
	
}