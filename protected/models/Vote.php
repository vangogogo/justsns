<?php

class Vote extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'vote':
	 * @var integer $id
	 * @var integer $topicid
	 * @var integer $uid
	 * @var string $username
	 * @var string $subject
	 * @var integer $votercount
	 * @var integer $replycount
	 * @var integer $multiple
	 * @var integer $maxchoice
	 * @var integer $sex
	 * @var integer $noview
	 * @var integer $novote
	 * @var integer $noreply
	 * @var integer $credit
	 * @var integer $percredit
	 * @var integer $expiration
	 * @var integer $lastvote
	 * @var integer $ctime
	 * @var integer $hot
	 * @var string $message
	 * @var string $summary
	 * @var integer $state
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
		return 'vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, subject', 'required'),
			array('topicid, uid, votercount, replycount, multiple, maxchoice, sex, noview, novote, noreply, credit, percredit, expiration, lastvote, ctime, hot, state', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>15),
			array('subject', 'length', 'max'=>80),
			array('message, summary', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topicid, uid, username, subject, votercount, replycount, multiple, maxchoice, sex, noview, novote, noreply, credit, percredit, expiration, lastvote, ctime, hot, message, summary, state', 'safe', 'on'=>'search'),
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
			'topicid' => 'Topicid',
			'uid' => 'Uid',
			'username' => 'Username',
			'subject' => 'Subject',
			'votercount' => 'Votercount',
			'replycount' => 'Replycount',
			'multiple' => 'Multiple',
			'maxchoice' => 'Maxchoice',
			'sex' => 'Sex',
			'noview' => 'Noview',
			'novote' => 'Novote',
			'noreply' => 'Noreply',
			'credit' => 'Credit',
			'percredit' => 'Percredit',
			'expiration' => 'Expiration',
			'lastvote' => 'Lastvote',
			'ctime' => 'Ctime',
			'hot' => 'Hot',
			'message' => 'Message',
			'summary' => 'Summary',
			'state' => 'State',
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

		$criteria->compare('topicid',$this->topicid);

		$criteria->compare('uid',$this->uid);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('subject',$this->subject,true);

		$criteria->compare('votercount',$this->votercount);

		$criteria->compare('replycount',$this->replycount);

		$criteria->compare('multiple',$this->multiple);

		$criteria->compare('maxchoice',$this->maxchoice);

		$criteria->compare('sex',$this->sex);

		$criteria->compare('noview',$this->noview);

		$criteria->compare('novote',$this->novote);

		$criteria->compare('noreply',$this->noreply);

		$criteria->compare('credit',$this->credit);

		$criteria->compare('percredit',$this->percredit);

		$criteria->compare('expiration',$this->expiration);

		$criteria->compare('lastvote',$this->lastvote);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('hot',$this->hot);

		$criteria->compare('message',$this->message,true);

		$criteria->compare('summary',$this->summary,true);

		$criteria->compare('state',$this->state);

		return new CActiveDataProvider('Vote', array(
			'criteria'=>$criteria,
		));
	}
}