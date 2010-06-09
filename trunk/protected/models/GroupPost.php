<?php

class GroupPost extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'group_post':
	 * @var integer $id
	 * @var integer $gid
	 * @var integer $uid
	 * @var integer $tid
	 * @var string $content
	 * @var string $ip
	 * @var integer $istopic
	 * @var integer $ctime
	 * @var integer $status
	 * @var integer $quote
	 * @var string $is_del
	 * @var string $attach
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
		return '{{group_post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid, uid, tid, istopic, ctime, status, quote', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>16),
			array('is_del', 'length', 'max'=>1),
			array('content, attach', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, uid, tid, content, ip, istopic, ctime, status, quote, is_del, attach', 'safe', 'on'=>'search'),
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
			'topic' => array(self::BELONGS_TO, 'Topic', 'tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'gid' => '小组编号',
			'uid' => '作者编号',
			'tid' => '主题编号',
			'content' => '内容',
			'ip' => 'Ip',
			'istopic' => '是否主题',
			'ctime' => '添加时间',
			'status' => '状态',
			'quote' => 'Quote',
			'is_del' => '是否删除',
			'attach' => '附件',
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

		$criteria->compare('gid',$this->gid);

		$criteria->compare('uid',$this->uid);

		$criteria->compare('tid',$this->tid);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('ip',$this->ip,true);

		$criteria->compare('istopic',$this->istopic);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('status',$this->status);

		$criteria->compare('quote',$this->quote);

		$criteria->compare('is_del',$this->is_del,true);

		$criteria->compare('attach',$this->attach,true);

		return new CActiveDataProvider('GroupPost', array(
			'criteria'=>$criteria,
		));
	}
}