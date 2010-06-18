<?php

class Comment extends CActiveRecord
{
	public $face;
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
		return '{{comment}}';
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
			array('type, appid, name, uid, comment, ctime, status', 'required'),
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
			'subcomments' => array(self::HAS_MANY, 'Comment', 'toId', 'condition'=>'subcomments.status= 0', 'order'=>'subcomments.ctime DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'type' => '类型',
			'appid' => '类型id',
			'name' => '发表人',
			'uid' => '发表人id',
			'comment' => '评论内容',
			'ctime' => '评论时间',
			'toId' => '回复评论',
			'status' => '状态',
			'quietly' => '是否悄悄话',
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
	
	/**
	 * Prepares attributes before performing validation.
	 */
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->uid=Yii::app()->user->id;
			$this->name=Yii::app()->user->name;
			$this->ctime=time();
			$this->status = 0;
		}
		return true;
	}
	
	protected function afterFind()
	{
		$smile = new Smile();
		$this->comment =  $smile->replaceContent($this->comment);
		$this->face = User::model()->getUserFace($this->uid);
	}
		
	public function getComments($type,$appid,$page = 0,$order='ctime DESC')
	{
		$model = self::model();
		//$comments = $model->findAll($criteria);
		//return $comments;
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order=$order;
		$criteria->condition="type=:type AND appid=:appid AND status != :status AND toId = 0";
		$criteria->params=array(':type'=>$type,':appid'=>$appid,':status'=>-1);
		$comments = $model->findAll($criteria);

		return $comments;
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
	
	public function deleteCommentById($id)
	{
		$model = $this->findByPk($id);
		if(!empty($model))
		{
			if($model['uid'] == Yii::app()->user->id)
			{
				$model->status = -1;
				return $model->save();
			}
//			echo "不是本人";
		}
		return false;
	}
		
	public function addComment($params)
	{
		$model = $this;
		$model->attributes = $params;
		$model->save();
		
		$model->face = User::model()->getUserFace($this->uid);
		
		return $model;
	}
	
	/**
	 * 获得心情的评论，心情的评论格式不同
	 * @param unknown_type $params
	 */
	public function getReplys($params)
	{
		$type = $params['type'];
		$appid = $params['appid'];
		
		$model = self::model();
		//$comments = $model->findAll($criteria);
		//return $comments;
		 //初始化
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="type=:type AND appid=:appid AND status != :status";
		$criteria->params=array(':type'=>$type,':appid'=>$appid,':status'=>-1);
		$comments = $model->findAll($criteria);
		
		return $comments;
	}
}
