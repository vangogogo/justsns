<?php

class GiftCategory extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Gift_category':
	 * @var integer $id
	 * @var string $name
	 * @var string $desc
	 * @var integer $ctime
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
		return 'gift_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, desc, ctime', 'required'),
			array('ctime', 'numerical', 'integerOnly'=>true),
			array('name, desc', 'length', 'max'=>255),
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
			'name' => '名称',
			'desc' => '描述',
			'ctime' => '添加时间',
		);
	}
	
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->ctime=time();
		}

		return true;
	}
	
	/**
	 * 分类不可以删除
	 */
	protected function beforeDelete() 
	{
		if($this->id != 0)
		{
			return true;
		}
	}	
		
	/**
	 * 分类删除后,所有分类下的Gift的categoryId都修改为0
	 */
	protected function afterDelete() 
	{
		$model = new Gift();
		$attributes = array(
			'categoryId'=>0,
		);
		$condition = "categoryId={$this->id}";
		$model->updateAll($attributes,$condition);
	}	
}
