<?php

class Group extends YiicmsActiveRecord
{
	const PAGE_SIZE=20;
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	/**
	 * The followings are the available columns in table 'group':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $name
	 * @var string $intro
	 * @var string $logo
	 * @var string $announce
	 * @var integer $cid0
	 * @var integer $cid1
	 * @var integer $membercount
	 * @var integer $threadcount
	 * @var integer $postcount
	 * @var string $type
	 * @var integer $need_invite
	 * @var integer $need_verify
	 * @var integer $actor_level
	 * @var integer $brower_level
	 * @var integer $openUploadFile
	 * @var integer $whoUploadFile
	 * @var integer $openAlbum
	 * @var integer $whoCreateAlbum
	 * @var integer $whoUploadPic
	 * @var integer $anno
	 * @var integer $ipshow
	 * @var integer $invitepriv
	 * @var integer $createalbumpriv
	 * @var integer $uploadpicpriv
	 * @var integer $ctime
	 * @var integer $mtime
	 * @var integer $status
	 * @var integer $isrecom
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
		return '{{group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('uid,  membercount, threadcount, postcount, need_invite, need_verify, actor_level, brower_level, openUploadFile, whoUploadFile, openAlbum, whoCreateAlbum, whoUploadPic, anno, ipshow, invitepriv, createalbumpriv, uploadpicpriv, status, isrecom, is_del', 'numerical', 'integerOnly'=>true),
		array('name', 'length', 'max'=>32),
		array('logo', 'length', 'max'=>255),
		array('type', 'length', 'max'=>5),
		array('intro, announce, ctime, mtime,cid0, cid1', 'safe'),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, uid, name, intro, logo, announce, cid0, cid1, membercount, threadcount, postcount, type, need_invite, need_verify, actor_level, brower_level, openUploadFile, whoUploadFile, openAlbum, whoCreateAlbum, whoUploadPic, anno, ipshow, invitepriv, createalbumpriv, uploadpicpriv, ctime, mtime, status, isrecom, is_del', 'safe', 'on'=>'search'),
			
		array('name,type,intro','required'),
		array('name', 'checkGroupName', 'on'=> 'create'),
			
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '编号',
			'uid' => '创建者',
			'name' => '群组名',
			'intro' => '概况',
			'logo' => 'Logo',
			'announce' => '公告',
			'cid0' => '群大类',
			'cid1' => '子类',
			'membercount' => '成员数',
			'threadcount' => '话题数',
			'postcount' => '回复数',
			'type' => '类型',
			'need_invite' => 'Need Invite',
			'need_verify' => 'Need Verify',
			'actor_level' => 'Actor Level',
			'brower_level' => 'Brower Level',
			'openUploadFile' => 'Open Upload File',
			'whoUploadFile' => 'Who Upload File',
			'openAlbum' => 'Open Album',
			'whoCreateAlbum' => 'Who Create Album',
			'whoUploadPic' => 'Who Upload Pic',
			'anno' => 'Anno',
			'ipshow' => 'Ipshow',
			'invitepriv' => 'Invitepriv',
			'createalbumpriv' => 'Createalbumpriv',
			'uploadpicpriv' => 'Uploadpicpriv',
			'ctime' => '添加时间',
			'mtime' => '确认时间',
			'status' => '状态',
			'isrecom' => 'Isrecom',
			'is_del' => '是否删除',
		);
	}

	/**
	 * 检查群组名是否存在
	 */
	public function checkGroupName() {
		$model = self::model();
		$error_msg = '';
		if($model->count('name=:name', array(':name'=>$this->name)) > 0) {
			$error_msg = 'name already exist';
			$this->addError('email',$error_msg);
			return false;
		}
		else
		{
			return true;
		}
	}
	/**
	 * 群组类型
	 */
	public function getTypeOptions()
	{
		return array(
			'open'=>'开放',
			'limit'=>'限制',
			'close'=>'关闭',
		);
	}
	/**
	 * Prepares attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->ctime=time();
			$this->uid = Yii::app()->user->id;
		}
		else
			$this->mtime=time();
			
		
		return true;
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

		$criteria->compare('intro',$this->intro,true);

		$criteria->compare('logo',$this->logo,true);

		$criteria->compare('announce',$this->announce,true);

		$criteria->compare('cid0',$this->cid0);

		$criteria->compare('cid1',$this->cid1);

		$criteria->compare('membercount',$this->membercount);

		$criteria->compare('threadcount',$this->threadcount);

		$criteria->compare('postcount',$this->postcount);

		$criteria->compare('type',$this->type,true);

		$criteria->compare('need_invite',$this->need_invite);

		$criteria->compare('need_verify',$this->need_verify);

		$criteria->compare('actor_level',$this->actor_level);

		$criteria->compare('brower_level',$this->brower_level);

		$criteria->compare('openUploadFile',$this->openUploadFile);

		$criteria->compare('whoUploadFile',$this->whoUploadFile);

		$criteria->compare('openAlbum',$this->openAlbum);

		$criteria->compare('whoCreateAlbum',$this->whoCreateAlbum);

		$criteria->compare('whoUploadPic',$this->whoUploadPic);

		$criteria->compare('anno',$this->anno);

		$criteria->compare('ipshow',$this->ipshow);

		$criteria->compare('invitepriv',$this->invitepriv);

		$criteria->compare('createalbumpriv',$this->createalbumpriv);

		$criteria->compare('uploadpicpriv',$this->uploadpicpriv);

		$criteria->compare('ctime',$this->ctime);

		$criteria->compare('mtime',$this->mtime);

		$criteria->compare('status',$this->status);

		$criteria->compare('isrecom',$this->isrecom);

		$criteria->compare('is_del',$this->is_del);

		return new CActiveDataProvider('Group', array(
			'criteria'=>$criteria,
		));
	}

	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
        );
    }

	public function addTopic($params)
	{
		$model = new GroupTopic();
		$params['gid'] = $this->id;
		$topic = $model->addTopic($params);
		if(empty($topic->errors))
		{
			$this->threadcount += 1;
			$this->save();
		}
		return $topic;
	}

	public function getGroupMembers(array $params = array(),$limit = '')
	{
		$gid = $this->id;
		$model = new GroupMember();
		$criteria=new CDbCriteria;
		$criteria->condition.=" gid = :gid";
		$criteria->params[':gid']=$gid;
		$criteria->order = !empty($params['order'])?$params['order']:'t.ctime';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'status','level'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and t.{$key}=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}
		$pages = '';
		if(!empty($params['pageSize']))
		{
			$pageSize = $params['pageSize'];
			$page = $params['page'];
			$_GET['page'] = $page;
			$total = $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			$pages->applyLimit($criteria);
		}
		$models=$model->with('user')->findAll($criteria);
		$data = array(
			'members'=>$models,
			'pages' => $pages,
		);
		return $data;
	}

	public function getGroupFriends(array $params = array(), $limit = '6')
	{
		$gid = $this->id;
		$model = new GroupFriend();
		$criteria=new CDbCriteria;
		$criteria->condition.=" gid = :gid";
		$criteria->params[':gid']=$gid;
		$criteria->order = !empty($params['order'])?$params['order']:'ctime';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'status','level'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and $key=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}
		$pageSize = $params['pageSize'];
		if(!empty($pageSize))
		{
			$page = $params['page'];
			$_GET['page'] = $page;
			$total = $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			$pages->applyLimit($criteria);
		}
		$models=$model->findAll($criteria);
		$data = array(
			'groups'=>$models,
			'pages' => $pages,
		);
		return $data;
	}

	public function getGroupThreads(array $params = array(), $limit = 0)
	{
		$gid = $this->id;
		if(!empty($gid) AND !isset($params))
		{
			$params['gid'] = $gid;
		}
		if(empty($params['is_del']))
		{
			$params['is_del'] = 0;
		}
		$model = new GroupTopic();
		$criteria=new CDbCriteria;
		$criteria->condition.=" 1";

		$criteria->order = !empty($params['order'])?$params['order']:'replytime DESC';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'uid','gid','dist','top','lock','is_del'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and t.{$key}=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}

		    $pages = '';
		    if(!empty($params['pageSize']))
		    {
				$pageSize = $params['pageSize'];

			    $page = $params['page'];
			    $_GET['page'] = $page;
			    $total = $model->count($criteria);
			    $pages=new CPagination($total);
			    $pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			    $pages->applyLimit($criteria);
		    }

		$models=$model->with('user','group')->findAll($criteria);
		#$models=$model->findAll($criteria);
		$data = array(
			'threads'=>$models,
			'pages' => $pages,
		);
		return $data;
	}

	public function getGroupNewThreads(array $params = array(), $limit = '6')
	{
		$data = $this->getGroupThreads($params,$limit);
		$members = $data['threads'];
		return $members;
	}

	public function getGroupNewMembers(array $params = array(), $limit = '6')
	{
		$data = $this->getGroupMembers();
		$members = $data['members'];
		return $members;
	}

	public function getGroupNewFriends(array $params = array(), $limit = '6')
	{
		$data = $this->getGroupMembers();
		$members = $data['groups'];
		return $members;
	}
	
	public function loadMember($uid)
	{
		$gid = $this->id;
		if(empty($uid))
		{
			$uid = Yii::app()->user->id;
		}
		$model = new GroupMember();
		$criteria=new CDbCriteria;
		$criteria->condition.=" 1 AND gid = :gid AND uid = :uid";
		$criteria->params = array(':gid'=>$gid,':uid'=>$uid);
		$member = $model->find($criteria);
		return $member;
	}
	
	public function isAdmin($uid)
	{
		$member = $this->loadMember($uid);
		if($member->level = 1)
		{
			return true;
		}
		return false;
	}
	
	public function isMember($uid)
	{
		$member = $this->loadMember($uid);
		if($member->level = 2)
		{
			return true;
		}
		return false;
	}
	public function isCreater($uid)
	{
		$member = $this->loadMember($uid);
		if($member->level = 3)
		{
			return true;
		}
		return false;
	}
	/**
	 * 读取话题
	 */
	public function loadGroup($id=null)
	{
		if($id!==null || isset($_POST['gid']))
        {
			$model=$this->with('user')->findbyPk($id!==null ? $id : $_POST['gid']);
        }   
		if($model===null)
			throw new CHttpException(404,'该话题不存在或已经被删除.');
		return $model;
	}
	
	public function getGroupCategory($params = array('pid'=>0))
	{
		if(!isset($params['status']))
		{
			$params['status'] = 1;
		}

		$model = new GroupCategory();
		$criteria=new CDbCriteria;
		$criteria->condition='1 ';
		$criteria->order = !empty($params['order'])?$params['order']:'title DESC';

		if(!empty($params))
		{
			$array = array(
				'pid','type'
			);
			foreach($params as $key => $value)
			{
				if(in_array($key,$array))
				{
					$criteria->condition.=" and $key=:$key";
					$criteria->params[':'.$key]=$value;
				}
			}
		}
		$models=$model->findAll($criteria);
		return $models;
	}
	
	
	public function getGroupPosts(array $params = array(), $limit = 0)
	{
		$model = new GroupPost();
		$criteria=new CDbCriteria;
		$criteria->condition.="1 AND istopic = 0";
		$criteria->order = !empty($params['order'])?$params['order']:'t.ctime';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'gid','tid','uid','quote','is_del'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and $key=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}

        if(empty($limit))
        {
		    $pageSize = $params['pageSize'];
		    if(!empty($pageSize))
		    {
			    $page = $params['page'];
			    $_GET['page'] = $page;
			    $total = $model->count($criteria);
			    $pages=new CPagination($total);
			    $pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			    $pages->applyLimit($criteria);
		    }
        }
		$models=$model->with('user')->findAll($criteria);
		$data = array(
			'post_list'=>$models,
			'post_pages' => $pages,
		);
		return $data;
	}
	
	public function getGroups($params = array(),$limit = 0)
	{
		
		if(!isset($params['status']))
		{
			$params['status'] = 1;
		}
		if(!isset($params['is_delete']))
		{
			$params['is_del'] = 0;
		}
			
		$model = new Group();
		$criteria=new CDbCriteria;
		$criteria->condition.="1";
		$criteria->order = !empty($params['order'])?$params['order']:'t.ctime';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'id','uid','cid0','cid1','type','status','is_del'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and $key=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}
		$pageSize = $params['pageSize'];
		if(!empty($pageSize))
		{
			$page = $params['page'];
			$_GET['page'] = $page;
			$total = $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			$pages->applyLimit($criteria);
		}
		$models=$model->findAll($criteria);
		$data = array(
			'group_list'=>$models,
			'group_pages' => $pages,
		);
		return $data;
	}
	
	public function getNewGroups()
	{
		$params = array();
		$limit = 16;
        $criteria=new CDbCriteria;
		$criteria->order = 'ctime';
		$criteria->limit = $limit;
        $models = $this->active()->findAll($criteria);
		return $models;
	}
	
	public function countGroups($params = array())
	{
		
		if(!isset($params['status']))
		{
			$params['status'] = 1;
		}
		if(!isset($params['is_delete']))
		{
			$params['is_del'] = 0;
		}
			
		$model = new Group();
		$criteria=new CDbCriteria;
		$criteria->condition.="1";
		$criteria->order = !empty($params['order'])?$params['order']:'t.ctime';
		if(!empty($limit))
		{
			$criteria->limit = $limit;
		}
		if(!empty($params))
		{
			$array = array(
				'id','uid','cid0','cid1','type','status','is_del'
				);
				foreach($params as $key => $value)
				{
					if(in_array($key,$array))
					{
						$criteria->condition.=" and $key=:$key";
						$criteria->params[':'.$key]=$value;
					}
				}
		}

		if(!empty($params['pageSize']))
		{
			$pageSize = $params['pageSize'];
			$page = $params['page'];
			$_GET['page'] = $page;
			$total = $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize?$pageSize:self::PAGE_SIZE;
			$pages->applyLimit($criteria);
		}
		$count=$model->count($criteria);
		return $count;
	}

	public function getGroupLogo()
	{
		if(empty($this->logo))
		{
			$this->logo = "/images/no-pic.jpg";
		}
		return $this->logo;
	}
}
