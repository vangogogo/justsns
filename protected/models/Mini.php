<?php

class Mini extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'mini':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $name
	 * @var integer $type
	 * @var string $content
	 * @var integer $tagId
	 * @var integer $ctime
	 * @var integer $status
	 * @var integer $reply_numbel
	 * @var integer $feedId
	 */
	public $time;
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
		return '{{mini}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, type, tagId, ctime, status, feedId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>10),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, name, type, content, tagId, ctime, status, feedId', 'safe', 'on'=>'search'),
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
			//心情所有者
			'user'=>array(self::BELONGS_TO, 'User', 'uid'),
			//所有回复
			'reply' => array(self::HAS_MANY, 'Comment', 'appid', 'condition'=>'reply.status= 0', 'order'=>'reply.ctime'),
			//第一条回复
			'first' => array(self::HAS_ONE, 'Comment', 'appid', 'condition'=>'first.status= 0', 'order'=>'first.ctime '),
			//最后一条回复
			'last' => array(self::HAS_ONE, 'Comment', 'appid', 'condition'=>'last.status= 0', 'order'=>'last.ctime DESC'),
			//回复总数
			'count' => array(self::STAT, 'Comment', 'appid', 'condition'=>'status= 0'),
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
			'name' => '用户名称',
			'type' => '表情类型',
			'content' => '内容',
			'tagId' => 'Tag',
			'ctime' => '添加时间',
			'status' => '状态',
			'reply_numbel' => '回复总数',
			'feedId' => 'Feed',
		);
	}
	/**
	 * getData
	 * 处理归档查询的时间格式
	 * @param string $date 200903这样格式的参数
	 * @static
	 * @access protected
	 * @return void
	 */	
	private function getMonthData($date)
	{
		//echo $date."<br/>";
		$year = $date[0].$date[1].$date[2].$date[3];
		$month = $date[4].$date[5];
		$start = mktime(0,0,0,$month,1,$year);
		$end   = mktime(0,0,0,$month+1,1,$year);
		return array( $start,$end );
	}
	
	/**
	 * fileAway 
	 * 归档查询
	 *
	 * @param string|array $findTime 查询时间。
	 * @param mixed $condition 查询条件
	 * @param Model $object 查询对象
	 * @param mixed $limit 查询limit
	 * @access public
	 * @return void
	 */
	public function fileAway($findTime,$criteria){
		$time = $this->getMonthData($findTime);
		$start = $time[0];
		$end = $time[1];
		$condition = "$start < t.ctime AND t.ctime < $end";
		$criteria->addCondition($condition);
		return $criteria;
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

		$criteria->compare('type',$this->type);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('tagId',$this->tagId);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('status',$this->status);

		$criteria->compare('reply_numbel',$this->reply_numbel);

		$criteria->compare('feedId',$this->feedId);

		return new CActiveDataProvider('mini', array(
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
			$this->uid=Yii::app()->user->id;
			$this->ctime=time();
			$user = User::model()->findByPk($this->uid);
			if(empty($user))
			{
				//提示没有这个用户
			}
			else
			{
				$this->name = $user->username;
			}
			$this->status = 0;
		}
		return true;
	}
	
	protected function afterFind()
	{
		$smile = new Smile();
		$this->content =  $smile->replaceContent($this->content);
	}
	
	public function getLastMiniByUid($uid)
	{
		$model = self::model();
		$criteria=new CDbCriteria;
		$criteria->order='ctime DESC';
		$criteria->condition="uid=:uid";
		$criteria->params=array(':uid'=>$uid);
		
		$mini = $model->find($criteria);
		return $mini;
	}
	
	public function deleteMiniById($id)
	{
		$mini = $this->findByPk($id);
		if(!empty($mini))
		{
			if($mini['uid'] == Yii::app()->user->id)
			{
				$mini->status = -1;
				return $mini->save();
			}
//			echo "不是本人";
		}
		return false;
	}
    public function afterSave()
    {
        $mini = $this->content;
        $user = User::model()->findByPk($this->uid);
        $user->profile->mini = $mini;
        $user->profile->save();

    }
}
