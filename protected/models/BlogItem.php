<?php

/**
 * This is the model class for table "{{blog_item}}".
 *
 * The followings are the available columns in table '{{blog_item}}':
 * @property integer $id
 * @property integer $sourceId
 * @property integer $snapday
 * @property integer $pubdate
 * @property integer $boot
 * @property string $title
 * @property string $link
 * @property string $summary
 */
class BlogItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BlogItem the static model class
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
		return '{{blog_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sourceId, snapday, pubdate, boot', 'numerical', 'integerOnly'=>true),
			array('title, link', 'length', 'max'=>255),
			array('summary', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sourceId, snapday, pubdate, boot, title, link, summary', 'safe', 'on'=>'search'),
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
			'sourceId' => 'Source',
			'snapday' => 'Snapday',
			'pubdate' => 'Pubdate',
			'boot' => 'Boot',
			'title' => 'Title',
			'link' => 'Link',
			'summary' => 'Summary',
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

		$criteria->compare('sourceId',$this->sourceId);

		$criteria->compare('snapday',$this->snapday);

		$criteria->compare('pubdate',$this->pubdate);

		$criteria->compare('boot',$this->boot);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('link',$this->link,true);

		$criteria->compare('summary',$this->summary,true);

		return new CActiveDataProvider('BlogItem', array(
			'criteria'=>$criteria,
		));
	}
}