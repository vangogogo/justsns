<?php

class mini extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'mini':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $name
	 * @var integer $type
	 * @var string $content
	 * @var integer $tagId
	 * @var integer $ctime
	 * @var integer $status
	 * @var integer $replay_numbel
	 * @var integer $feedId
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
		return 'mini';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, type, tagId, ctime, status, replay_numbel, feedId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>10),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, name, type, content, tagId, ctime, status, replay_numbel, feedId', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
			'content' => 'Content',
			'tagId' => 'Tag',
			'ctime' => 'Ctime',
			'status' => 'Status',
			'replay_numbel' => 'Replay Numbel',
			'feedId' => 'Feed',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('type',$this->type);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('tagId',$this->tagId);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('status',$this->status);

		$criteria->compare('replay_numbel',$this->replay_numbel);

		$criteria->compare('feedId',$this->feedId);

		return new CActiveDataProvider('mini', array(
			'criteria'=>$criteria,
		));
	}
}