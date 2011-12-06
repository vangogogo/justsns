<?php

class GroupPost extends YiicmsActiveRecord
{
	/**
	 * The followings are the available columns in table 'group_post':
	 * @var integer $id
	 * @var integer $gid
	 * @var integer $uid
	 * @var integer $tid
	 * @var string $content
	 * @var string $ip
	 * @var integer $istopic
	 * @var integer $ctime
	 * @var integer $status
	 * @var integer $quote
	 * @var string $is_del
	 * @var string $attach
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
		return '{{group_post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid, uid, tid, istopic, status, quote', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>16),
			array('is_del', 'length', 'max'=>1),
			array('content, attach, ctime, mtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, uid, tid, content, ip, istopic, ctime, status, quote, is_del, attach', 'safe', 'on'=>'search'),
			array('gid, uid, tid, content, ip, istopic', 'required'),
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
			//user
			'user'=>array(self::BELONGS_TO, 'User', 'uid'),	
			//所属群组
			'group'=>array(self::BELONGS_TO, 'Group', 'gid'),
			//所属话题
			'topic'=>array(self::BELONGS_TO, 'GroupTopic', 'tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'gid' => '小组编号',
			'uid' => '作者编号',
			'tid' => '主题编号',
			'content' => '内容',
			'ip' => 'Ip',
			'istopic' => '是否主题',
			'ctime' => '添加时间',
			'status' => '状态',
			'quote' => 'Quote',
			'is_del' => '是否删除',
			'attach' => '附件',
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

		$criteria->compare('tid',$this->tid);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('ip',$this->ip,true);

		$criteria->compare('istopic',$this->istopic);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('status',$this->status);

		$criteria->compare('quote',$this->quote);

		$criteria->compare('is_del',$this->is_del,true);

		$criteria->compare('attach',$this->attach,true);

		return new CActiveDataProvider('GroupPost', array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 读取话题
	 */
	public function loadPost($id=null)
	{
		if($id!==null || isset($_POST['pid']))
			$model=$this->findbyPk($id!==null ? $id : $_POST['pid']);
		if($model===null)
			throw new CHttpException(404,'该回复不存在.');
		return $model;
	}
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->uid = Yii::app()->user->id;
			$this->ip = Yii::app()->request->userHostAddress;
		}			
		return true;
	}
	
	/**
	 * 添加话题/回复后业务处理
	 */	
	protected function afterSave()
	{
		if($this->isNewRecord)
		{
			//主题
			if($this->istopic == '1') 
			{
				//Group::model()->updateCounters(array('threadcount'=>1), "id={$this->gid}");
			}
			else
			{
			
				//回复
				//GroupTopic::model()->updateCounters(array('postcount'=>+1,'replytime'=> $this->ctime), "id={$this->tid}");
				$topic = GroupTopic::model()->loadTopic($this->tid);
				$topic->postcount += 1;
				$topic->replytime = $this->ctime;
				$topic->save();
				
				//TODO有邮件提醒本帖回复,并且不是自己回复
				if($topic->isrecom == 1 && $this->uid != $topic->uid)
				{
					$user = $topic->user;
					if(!empty($user->email))
					{
						//邮件内容
						
					}
				}
			}

		}
	}

	/**
	 * 删除话题/回复前业务处理
	 */	
	protected function beforerDelete()
	{
		die("我要删除");
		if($this->uid != Yii::app()->user->id)
		{
			return false;
		}
		return true;
	}
	public function delPost()
	{
		if($this->is_del == 1)
		{
			return true;
		}
		
		if(!$this->getIsNewRecord())
		{
			Yii::trace(get_class($this).'.delete()','system.db.ar.CActiveRecord');
			if($this->beforeDelete())
			{
				$this->is_del = 1;
				$result = $this->save();
				$this->afterDelete();
				return $result;
			}
			else
				return false;
		}
		else
			throw new CDbException(Yii::t('yii','The active record cannot be deleted because it is new.'));
	}
	/**
	 * 删除话题/回复后业务处理
	 */	
	protected function afterDelete()
	{
		if($this->istopic == '1') {
			GroupTopic::model()->deleteByPk($this->tid);
			//Group::model()->updateCounters(array('threadcount'=>-1), "id={$this->gid}");
		}else{
			GroupTopic::model()->updateCounters(array('postcount'=>-1), "id={$this->tid}");
		}
	}
	
	public function addPost($params)
	{
		$this->attributes = $params;
		$this->save();
		return $this;
	}	
}
