<?php

class smile extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'smile':
	 * @var integer $id
	 * @var string $type
	 * @var string $emotion
	 * @var string $filename
	 * @var string $title
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
		return 'smile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, emotion', 'length', 'max'=>10),
			array('filename', 'length', 'max'=>20),
			array('title', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, emotion, filename, title', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'emotion' => 'Emotion',
			'filename' => 'Filename',
			'title' => 'Title',
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

		$criteria->compare('type',$this->type,true);

		$criteria->compare('emotion',$this->emotion,true);

		$criteria->compare('filename',$this->filename,true);

		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider('smile', array(
			'criteria'=>$criteria,
		));
	}
}