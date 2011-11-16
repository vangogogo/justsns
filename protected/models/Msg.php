<?php

class Msg extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'msg':
	 * @var integer $id
	 * @var integer $fromUserId
	 * @var integer $toUserId
	 * @var string $subject
	 * @var string $content
	 * @var integer $ctime
	 * @var integer $is_read
	 * @var integer $replyMsgId
	 * @var integer $is_new
	 * @var integer $is_del
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
		return '{{msg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromUserId, toUserId, ctime, is_read, replyMsgId, is_new, is_del', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('content', 'safe'),
			array('subject, content, toUserId', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fromUserId, toUserId, subject, content, ctime, is_read, replyMsgId, is_new, is_del', 'safe', 'on'=>'search'),
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
			'fromUser'=>array(self::BELONGS_TO, 'User', 'fromUserId'),
			'toUser'=>array(self::BELONGS_TO, 'User', 'toUserId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'fromUserId' => 'From User',
			'toUserId' => 'To User',
			'subject' => '标题',
			'content' => '内容',
			'ctime' => 'Ctime',
			'is_read' => 'Is Read',
			'replyMsgId' => 'Reply Msg',
			'is_new' => 'Is New',
			'is_del' => 'Is Del',
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

		$criteria->compare('fromUserId',$this->fromUserId);

		$criteria->compare('toUserId',$this->toUserId);

		$criteria->compare('subject',$this->subject,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('is_read',$this->is_read);

		$criteria->compare('replyMsgId',$this->replyMsgId);

		$criteria->compare('is_new',$this->is_new);

		$criteria->compare('is_del',$this->is_del);

		return new CActiveDataProvider('Msg', array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->fromUserId=Yii::app()->user->id;
			$this->is_read = 0;
			$this->ctime = time();
			$this->is_del = 0;
		}

		return true;
	}
	/**
	 * 读信息
	 */
	public function readMsg()
	{
		if($this->is_read == 0 AND $this->toUserId == Yii::app()->user->id)
		{
			$this->is_read = 1;
			$this->is_new = 0;
			$this->save();
		}
	}
	
	/**
	 * 读取话题
	 */
	public function loadMsg($id=null)
	{
		if($id!==null || isset($_POST['tid']))
			$model=$this->findbyPk($id!==null ? $id : $_POST['tid']);
		if($model===null)
			throw new CHttpException(404,'该话题不存在.');
		if($model->is_del != 0)
			throw new CHttpException(404,'该话题不存在或被删除.');
		return $model;
	}	
	
	public function delMsg()
	{
        #return false;
		if($this->fromUserId == Yii::app()->user->id OR $this->toUserId == Yii::app()->user->id)
		{
			$this->is_del = 1;
			$this->save();
			return true;
		}
		return false;
	}
}
