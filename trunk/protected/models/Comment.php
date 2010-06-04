<?php

class Comment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'comment':
	 * @var integer $id
	 * @var string $type
	 * @var integer $appid
	 * @var string $name
	 * @var integer $uid
	 * @var string $comment
	 * @var integer $ctime
	 * @var integer $toId
	 * @var integer $status
	 * @var integer $quietly
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appid, uid, ctime, toId, status, quietly', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>15),
			array('name', 'length', 'max'=>30),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, appid, name, uid, comment, ctime, toId, status, quietly', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO, 'User', 'uid'),
			'subcomment' => array(self::HAS_MANY, 'Comment', 'toId'),
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
			'appid' => 'Appid',
			'name' => 'Name',
			'uid' => 'Uid',
			'comment' => 'Comment',
			'ctime' => 'Ctime',
			'toId' => 'To',
			'status' => 'Status',
			'quietly' => 'Quietly',
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

		$criteria->compare('appid',$this->appid);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('uid',$this->uid);

		$criteria->compare('comment',$this->comment,true);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('toId',$this->toId);

		$criteria->compare('status',$this->status);

		$criteria->compare('quietly',$this->quietly);

		return new CActiveDataProvider('comment', array(
			'criteria'=>$criteria,
		));
	}
	
	public function getComments($type,$appid,$page = 0)
	{
		$model = self::model();
		//$comments = $model->findAll($criteria);
		//return $comments;
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="type=:type AND appid=:appid AND status != :status";
		$criteria->params=array(':type'=>$type,':appid'=>$appid,':status'=>-1);
		$comments = $model->findAll($criteria);
	
		return $commets;
	}
	
	public function getCount($type,$appid,$page = 0)
	{
		$model = self::model();
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="type=:type AND appid=:appid AND status != :status";
		$criteria->params=array(':type'=>$type,':appid'=>$appid,':status'=>-1);
		$count = $model->count($criteria);
	
		return $count;
	}
	
	public function deleteByAttributes($params)
	{
		$model = self::model();
		$comment = $model->findByAttributes($params);
		if(!empty($comment))
		{
			$comment->status = -1;
			return $comment->save();
		}
		return false;
	}
}