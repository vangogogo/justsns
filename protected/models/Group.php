<?php

class Group extends CActiveRecord
{
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
		return 'group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, cid0, cid1, membercount, threadcount, postcount, need_invite, need_verify, actor_level, brower_level, openUploadFile, whoUploadFile, openAlbum, whoCreateAlbum, whoUploadPic, anno, ipshow, invitepriv, createalbumpriv, uploadpicpriv, ctime, mtime, status, isrecom, is_del', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('logo', 'length', 'max'=>255),
			array('type', 'length', 'max'=>5),
			array('intro, announce', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, name, intro, logo, announce, cid0, cid1, membercount, threadcount, postcount, type, need_invite, need_verify, actor_level, brower_level, openUploadFile, whoUploadFile, openAlbum, whoCreateAlbum, whoUploadPic, anno, ipshow, invitepriv, createalbumpriv, uploadpicpriv, ctime, mtime, status, isrecom, is_del', 'safe', 'on'=>'search'),
			
			array('name,type,cid0,intro','required', 'on' => 'create'),
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
			'type' => 'Type',
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
}