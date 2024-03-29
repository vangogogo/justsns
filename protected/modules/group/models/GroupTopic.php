<?php

class GroupTopic extends YiicmsActiveRecord
{
	public $group_name;
	/**
	 * The followings are the available columns in table 'group_topic':
	 * @var integer $id
	 * @var integer $gid
	 * @var integer $uid
	 * @var string $name
	 * @var string $title
	 * @var integer $viewcount
	 * @var integer $postcount
	 * @var integer $dist
	 * @var integer $top
	 * @var integer $lock
	 * @var integer $ctime
	 * @var integer $replytime
	 * @var integer $mtime
	 * @var integer $status
	 * @var integer $isrecom
	 * @var integer $is_del
	 * @var string $attach
	 */
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;
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
		return '{{group_topic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid, uid, viewcount, postcount, dist, top, lock, status, isrecom, is_del', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>36),
			array('title', 'length', 'max'=>255),
            array('title,content','required'),
			array('attach, ctime, replytime, mtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, uid, name, title, viewcount, postcount, dist, top, lock, ctime, replytime, mtime, status, isrecom, is_del, attach', 'safe', 'on'=>'search'),


			//array('name', 'checkGroupName', 'on'=> 'create'),
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
			'author' => array(self::BELONGS_TO, 'User', 'uid'),
            'user' => array(self::BELONGS_TO, 'User', 'uid'),
			'group' => array(self::BELONGS_TO, 'Group', 'gid'),
			'comments' => array(self::HAS_MANY, 'GroupPost', 'tid', 'condition'=>'comments.status= 1', 'order'=>'comments.ctime DESC'),
			'commentCount' => array(self::STAT, 'GroupPost', 'tid', 'condition'=>'group_post.status= 1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'gid' => '小组id',
			'uid' => '作者',
			'name' => '名称',
			'title' => '主题',
			'viewcount' => '浏览数',
			'postcount' => '回复数',
			'dist' => '精华',
			'top' => '置顶',
			'lock' => '锁定',
			'ctime' => '添加时间',
			'replytime' => '最后回复时间',
			'mtime' => '编辑时间',
			'status' => '状态',
			'isrecom' => 'Isrecom',
			'is_del' => '是否删除',
			'attach' => '附件',
            'content'=>'内容',
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

		$criteria->compare('gid',$this->gid);

		$criteria->compare('uid',$this->uid);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('viewcount',$this->viewcount);

		$criteria->compare('postcount',$this->postcount);

		$criteria->compare('dist',$this->dist);

		$criteria->compare('top',$this->top);

		$criteria->compare('lock',$this->lock);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('replytime',$this->replytime);

		$criteria->compare('mtime',$this->mtime);

		$criteria->compare('status',$this->status);

		$criteria->compare('isrecom',$this->isrecom);

		$criteria->compare('is_del',$this->is_del);

		$criteria->compare('attach',$this->attach,true);

		return new CActiveDataProvider('GroupTopic', array(
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
	/**
	 * 读取话题
	 */
	public function loadTopic($id=null)
	{
		if($id!==null || isset($_POST['tid']))
			$model=$this->with('user')->findbyPk($id!==null ? $id : $_POST['tid']);
		if($model===null)
			throw new CHttpException(404,'该话题不存在.');
		if($model->is_del != 0)
			throw new CHttpException(404,'该话题不存在或被删除.');
		return $model;
	}

	public function getTopicTitle()
	{	
		$title = strip_tags(htmlspecialchars($this->title));
		//TODO 缓存
		return $title;
	}
	
	public function getTopicContent()
	{
		//TODO 缓存
		return $this->content;
	}
	
	public function addTopic($params)
	{
		$this->attributes = $params;
		$this->save();

		return $this;
	}

	public function setTopic($params)
	{
		$this->attributes = $params;
		$this->save();
		return $this;
	}
	
	public function delTopic()
	{
		if($this->uid == Yii::app()->user->id OR 1)
		{
			$this->is_del = 1;
			$this->save();
			return true;
		}
		return false;
	}
	
	public function setOption($option,$value)
	{
		if(!in_array($option, array('dist','top','lock'))) {
			throw new CHttpException(404,'非法选项.');
		}
		$this->$option = $value;
		$this->save();
		return !empty($this->errors)?-1:1;
	}
	/**
	 * 插入信息
	 */
	protected function afterSave() 
	{
		//标签更新,无条件判定
		if(0)
		{
			foreach($this->getTagArray() as $name)
			{
				if(($tag=GroupTag::model()->findByAttributes(array('name'=>$name)))===null)
				{
					$tag=new GroupTag;
					$tag->name=$name;
					$tag->save();
				}
				$this->dbConnection->createCommand("INSERT INTO group_topic_tag (tid, tagid) VALUES ({$this->id},{$tag->id})")->execute();
			}
		}
		
	}
}
