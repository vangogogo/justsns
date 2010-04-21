<?php

class GroupTopic extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'group_topic':
	 * @var integer $id
	 * @var integer $gid
	 * @var integer $uid
	 * @var string $name
	 * @var string $title
	 * @var integer $viewcount
	 * @var integer $postcount
	 * @var integer $dist
	 * @var integer $top
	 * @var integer $lock
	 * @var integer $addtime
	 * @var integer $replytime
	 * @var integer $mtime
	 * @var integer $status
	 * @var integer $isrecom
	 * @var integer $is_del
	 * @var string $attach
	 */
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;
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
		return 'group_topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid, uid, viewcount, postcount, dist, top, lock, addtime, replytime, mtime, status, isrecom, is_del', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>36),
			array('title', 'length', 'max'=>255),
			array('attach', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, uid, name, title, viewcount, postcount, dist, top, lock, addtime, replytime, mtime, status, isrecom, is_del, attach', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'user', 'uid'),
			'comments' => array(self::HAS_MANY, 'GroupPost', 'tid', 'condition'=>'comments.status= 1', 'order'=>'comments.ctime DESC'),
			'commentCount' => array(self::STAT, 'GroupPost', 'tid', 'condition'=>'group_post.status= 1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'gid' => '小组id',
			'uid' => '作者',
			'name' => '名称',
			'title' => '主题',
			'viewcount' => '浏览数',
			'postcount' => '回复数',
			'dist' => '精华',
			'top' => '置顶',
			'lock' => '锁定',
			'addtime' => '添加时间',
			'replytime' => '最后回复时间',
			'mtime' => '编辑时间',
			'status' => '状态',
			'isrecom' => 'Isrecom',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('viewcount',$this->viewcount);

		$criteria->compare('postcount',$this->postcount);

		$criteria->compare('dist',$this->dist);

		$criteria->compare('top',$this->top);

		$criteria->compare('lock',$this->lock);

		$criteria->compare('addtime',$this->addtime);

		$criteria->compare('replytime',$this->replytime);

		$criteria->compare('mtime',$this->mtime);

		$criteria->compare('status',$this->status);

		$criteria->compare('isrecom',$this->isrecom);

		$criteria->compare('is_del',$this->is_del);

		$criteria->compare('attach',$this->attach,true);

		return new CActiveDataProvider('GroupTopic', array(
			'criteria'=>$criteria,
		));
	}
}