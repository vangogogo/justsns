<?php

/**
 * This is the model class for table "{{blog_outline}}".
 *
 * The followings are the available columns in table '{{blog_outline}}':
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property string $title
 * @property integer $category
 * @property string $cover
 * @property string $content
 * @property integer $readCount
 * @property integer $commentCount
 * @property string $tags
 * @property integer $cTime
 * @property integer $mTime
 * @property string $isHot
 * @property integer $type
 * @property string $status
 * @property integer $private
 * @property integer $hot
 * @property string $friendId
 * @property integer $canableComment
 */
class BlogOutline extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BlogOutline the static model class
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
		return '{{blog_outline}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, category, readCount, commentCount, cTime, mTime, type, private, hot, canableComment', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('title, cover, tags', 'length', 'max'=>255),
			array('isHot, status', 'length', 'max'=>1),
			array('content, friendId', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, name, title, category, cover, content, readCount, commentCount, tags, cTime, mTime, isHot, type, status, private, hot, friendId, canableComment', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'category' => 'Category',
			'cover' => 'Cover',
			'content' => 'Content',
			'readCount' => 'Read Count',
			'commentCount' => 'Comment Count',
			'tags' => 'Tags',
			'cTime' => 'C Time',
			'mTime' => 'M Time',
			'isHot' => 'Is Hot',
			'type' => 'Type',
			'status' => 'Status',
			'private' => 'Private',
			'hot' => 'Hot',
			'friendId' => 'Friend',
			'canableComment' => 'Canable Comment',
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

		$criteria->compare('title',$this->title,true);

		$criteria->compare('category',$this->category);

		$criteria->compare('cover',$this->cover,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('readCount',$this->readCount);

		$criteria->compare('commentCount',$this->commentCount);

		$criteria->compare('tags',$this->tags,true);

		$criteria->compare('cTime',$this->cTime);

		$criteria->compare('mTime',$this->mTime);

		$criteria->compare('isHot',$this->isHot,true);

		$criteria->compare('type',$this->type);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('private',$this->private);

		$criteria->compare('hot',$this->hot);

		$criteria->compare('friendId',$this->friendId,true);

		$criteria->compare('canableComment',$this->canableComment);

		return new CActiveDataProvider('BlogOutline', array(
			'criteria'=>$criteria,
		));
	}
}