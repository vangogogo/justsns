<?php

class FriendGroup extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'friend_group':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $name
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
		return '{{friend_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'numerical', 'integerOnly'=>true),
			array('uid', 'required'),
			array('name', 'length', 'max'=>255),
			
			array('name','required', 'on' => 'add'),
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
			'uid' => '用户id',
			'name' => '分组名',
		);
	}
	
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->uid=Yii::app()->user->id;
		}
		return true;
	}

	/**
	 * 分组删除后，自动删除FriendBelongGroup的关系
	 */
	protected function afterDelete() 
	{
		//增加uid,防止删除系统的gid
		$condition = "(uid = {$this->uid} AND gid={$this->id})";
		FriendBelongGroup::model()->deleteAll($condition);
	}		
}
