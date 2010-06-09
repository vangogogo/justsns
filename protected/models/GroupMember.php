<?php

class GroupMember extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'group_member':
	 * @var integer $id
	 * @var integer $gid
	 * @var integer $uid
	 * @var string $name
	 * @var string $reason
	 * @var integer $status
	 * @var integer $level
	 * @var integer $ctime
	 * @var integer $mtime
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
		return '{{group_member}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid, uid, status, level, ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>10),
			array('reason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, uid, name, reason, status, level, ctime, mtime', 'safe', 'on'=>'search'),
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
			'gid' => '小组id',
			'uid' => '用户id',
			'name' => '用户名',
			'reason' => '加入理由',
			'status' => '状态',
			'level' => '等级',
			'ctime' => '添加时间',
			'mtime' => '确认时间',
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

		$criteria->compare('reason',$this->reason,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('level',$this->level);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('mtime',$this->mtime);

		return new CActiveDataProvider('GroupMember', array(
			'criteria'=>$criteria,
		));
	}
}