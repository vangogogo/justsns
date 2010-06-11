<?php

class Gift extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'gift':
	 * @var integer $id
	 * @var integer $categoryId
	 * @var string $name
	 * @var string $desc
	 * @var string $imgPath
	 * @var integer $status
	 * @var integer $order
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
		return '{{gift}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoryId, name, desc, imgPath, status, order, ctime, mtime', 'required'),
			array('categoryId, status, order, ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('desc, imgPath', 'length', 'max'=>255),
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
			'cate'=>array(self::BELONGS_TO, 'GiftCategory', 'categoryId'),		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'categoryId' => '分类',
			'name' => '名称',
			'desc' => '描述',
			'imgPath' => '图片路径',
			'status' => '状态',
			'order' => '排序',
			'ctime' => '创建时间',
			'mtime' => '修改时间',
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
			$this->mtime = 0;
		}
		else 
			$this->mtime = time();

			
		
		return true;
	}		
}