<?php

/**
 * This is the model class for table "{{people_contact}}".
 *
 * The followings are the available columns in table '{{people_contact}}':
 * @property integer $people_object_id
 * @property integer $uid
 * @property string $object_type
 * @property integer $object_id
 * @property integer $contact_group
 * @property string $ip
 * @property string $update_time
 * @property string $create_time
 * @property integer $is_delete
 */
class PeopleContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PeopleContact the static model class
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
		return '{{people_contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_type', 'required'),
			array('uid, object_id, contact_group, is_delete', 'numerical', 'integerOnly'=>true),
			array('object_type', 'length', 'max'=>20),
			array('ip', 'length', 'max'=>255),
			array('update_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('people_object_id, uid, object_type, object_id, contact_group, ip, update_time, create_time, is_delete', 'safe', 'on'=>'search'),
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
	 * 使用Yii::t('filename','要翻译的文字'),作为I18N化，filename文件位于protected/messages/zh_cn/下
	 */
	public function attributeLabels()
	{
		return array(
			'people_object_id' => Yii::t('admin','People Contact'),
			'uid' => Yii::t('admin','User'),
			'object_type' => Yii::t('admin','Object Type'),
			'object_id' => Yii::t('admin','Object'),
			'contact_group' => Yii::t('admin','Contact Group'),
			'ip' => Yii::t('admin','Ip'),
			'update_time' => Yii::t('admin','Update Time'),
			'create_time' => Yii::t('admin','Create Time'),
			'is_delete' => Yii::t('admin','Is Delete'),
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

		$criteria->compare('people_object_id',$this->people_object_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('contact_group',$this->contact_group);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('is_delete',$this->is_delete);
		if($this->is_delete == NULL)
		{
			$criteria->compare('is_delete',0);
		}


		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function isExist($uid,$object_type,$object_id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('uid',$uid);
		$criteria->compare('object_type',$object_type,true);
		$criteria->compare('object_id',$object_id);

		if($this->is_delete == NULL)
		{
			$criteria->compare('is_delete',0);
		}
		return $this->count($criteria);
	}

	private function getContactInfo($uid,$object_type,$object_id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('uid',$uid);
		$criteria->compare('object_type',$object_type,true);
		$criteria->compare('object_id',$object_id);
		if($this->is_delete == NULL)
		{
			$criteria->compare('is_delete',0);
		}
		return $this->find($criteria);
	}

	public function addContact($uid,$object_type,$object_id)
	{
		$isExist = $this->isExist($uid,$object_type,$object_id);

		$params = array(
			'uid'=>$uid,
			'object_type'=>$object_type,
			'object_id'=>$object_id,
		);

		if($isExist)
		{
			//查找存在的记录
			$contact = $this->getContactInfo($uid,$object_type,$object_id);
		}
		else
		{
			$contact = new PeopleContact();
		}

		$contact->attributes = $params;
		$contact->save();
		return $contact;
	}

	public function removeContact($uid,$object_type,$object_id)
	{
		$contact = $this->getContactInfo($uid,$object_type,$object_id);
		return $contact->delete();
	}

	/**
	 * 获取用户收藏的（视频, 课程）等等 信息
	 * @param string $object_type			获取该对象的数据(book ,video,course)
	 *				   int		$limit						读取多少条
	 *				   int		$pagesize			   分页大小
	 * @return: array model 。
	 * @author:majc
	 */
	public function getUserCollectByObjectType($object_type,$pagesize='',$limit ='')
	{
		switch ($object_type)
		{
			case 'book':
				$model = new Book();
				$objectPrimaryName = 'books_id';
				break;
			case 'courses':
				$model = new Lecture();
				$objectPrimaryName = 'lecture_id';
				break;
			case 'video':
				$model = new Video();
				$objectPrimaryName = 'id';
				break;
		}
		$uid = Yii::app()->user->id;
		$params = array(
			'model' => $model,
			'object_type' => $object_type,
			'uid'=>$uid,
			'objectPrimaryName'=>$objectPrimaryName,
			'limit' =>$limit,
			'pageSize' => $pagesize,
		);
		$data = $this->findUserCollectRecort($params);
		return $data;
	}
	
	/**
	 * 获取用户收藏信息的数据集
	 * @param: array $params array(
	 *		'model' => $bookModel,
	 *		'object_type' => 'book',
	 *		'uid'=>$uid,
	 *		'objectPrimaryName'=>'books_id',
	 *	);
	 *
	 * @return:array model;
	 * @author:majc
	 */
	public function findUserCollectRecort($params = array())
	{
		if (empty($params['model']) || empty($params['uid']) || empty($params['object_type']) || empty($params['objectPrimaryName']))
		{
			return null ;
		}

		$model = $params['model'];
		$criteria = new CDbCriteria();
		$criteria ->join = 'LEFT JOIN  hopecms_people_contact AS c  ON t.'.$params['objectPrimaryName'] .'= c.object_id';
		$criteria ->condition = 'c.object_type = :object_type AND c.uid = :uid';
		$criteria ->params = array(
			':object_type' =>$params['object_type'],
			':uid' =>$params['uid'],
		);

		if(!empty($params['limit']))
		{
			$criteria->limit = $params['limit'];
		}
		else
		{
			$pageSize = $params['pageSize']?$params['pageSize']:self::PAGE_SIZE;
			$total= $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize;
			$pagecount = ceil($total/$pageSize);
			$pages->applyLimit($criteria);
		}

		$models = $model->findAll($criteria);
		$data = array(
			'models' =>$models,
			'total'=>$total,
			'pagecount'=>$pagecount,
			'pages'=>$pages,
			'sort'=>$sort,
		);
		return $data;
	}
	
	/**
	 * @author:majc
	 * 在uchome 保存用户关注的动态信息
	 */
	public function afterSave()
	{
        return true;
		parent::afterSave();
		$model = new UchomeFeed();
		//后台判断是否显示动态
		if (!$model->isShowFeed()) {
			return null;
		}
		$board_content = '';
		$object_type = $this->object_type;
		$object_id = $this->object_id;
		$uid = Yii::app()->user->id;
		$username = Yii::app()->user->name;
		$dateline = strtotime("now");

		$icon = $model->getObject_type($object_type);
		$url = $model->getObjectLink($object_type,$object_id);
		$ObjectTypeInfo = $model->getObjectTypeInfo($object_type,$object_id);

		$setarr['icon'] = $icon;
		$setarr['id'] = $object_id;
		$setarr['idtype'] = $object_type;
		$setarr['uid'] = $uid;
		$setarr['username'] = $username;
		$setarr['dateline'] = $dateline;
		
		switch($object_type)
		{
			case 'mentor':	
					$url = Yii::app()->createAbsoluteUrl('mentor/lecturer/view',array('id'=>$object_id));
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('mentor'.$ObjectTypeInfo->lecturer_pic);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 关注 {module} 导师.';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->lecturer_name</a>");
					
					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
					$setarr['body_data'] = array(
						'img_url' => $url,
				//		'img_src' => $ObjectTypeInfo->lecturer_pic,
						'summary'=>$ObjectTypeInfo->lecturer_appellation,
						'people_board_id'=>$this->primaryKey,
					);
				break;

			case 'za_article':
					$Magazine_info = MagazineMagazine::model()->findByPk($ObjectTypeInfo->magazine_id);
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('magazine'.$Magazine_info->magazine_small_pic);
					$setarr['image_1_link'] = $url;
					$issueUrl = Yii::app()->createAbsoluteUrl('magazine/default/issue',array('id' =>$Magazine_info->magazine_id));
					$setarr['title_template'] = '{actor} 关注 {module} 杂志';
					$setarr['title_data'] = array('module' => "<a href=\"$issueUrl\">$Magazine_info->magazine_issue_name</a>");

					$setarr['body_template'] = '<a href="{img_url}"></a> <a href="{object_url}">{object_title}</a> {summary}';
				
					$img_src = "<img src='".$Magazine_info->magazine_small_pic."' />";
					$setarr['body_data'] = array(
						'img_url' => $url,
					//	'img_src' => $img_src,
						'object_url' => $url,
						'object_title' => $ObjectTypeInfo->article_title,
						'summary'=> $board_content,
						'people_board_id'=>$this->primaryKey,
					);
				break;
				
			case 'book':
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('mentor'.$ObjectTypeInfo->pic);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 关注 {module} 书籍';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->title</a>");

					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
				
					$img_src = "<img src='".$ObjectTypeInfo->pic."' />";
					$setarr['body_data'] = array(
						'img_url' => $url,
					//	'img_src' => $img_src,
						'summary'=> $board_content,
						'people_board_id'=>$this->primaryKey,
					);
				break;
			
			case 'video':
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('mentor'.$ObjectTypeInfo->pic);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 关注 {module} 视频';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->tit</a>");

					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
				
					$img_src = "<img src='".$ObjectTypeInfo->pic."' />";
					$setarr['body_data'] = array(
						'img_url' => $url,
					//	'img_src' => $img_src,
						'summary'=> $board_content,
						'people_board_id'=>$this->primaryKey,
					);
				break;
			
			case 'course':
					$disposeImgUrl = !empty($ObjectTypeInfo->lecture_pic) ? $ObjectTypeInfo->lecture_pic :'/css/happyschool/images/nav_pic.png';
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('/happyschool'.$disposeImgUrl);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 关注 {module} 课程';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->lecture_name</a>");

					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
				
					$img_src = "<img src='".$ObjectTypeInfo->lecture_pic ? YiicmsImage::getImageurl($ObjectTypeInfo->lecture_pic) :'/css/happyschool/images/nav_pic.png'."' />";
					$setarr['body_data'] = array(
						'img_url' => $url,
					//	'img_src' => $img_src,
						'summary'=> $board_content,
						'people_board_id'=>$this->primaryKey,
					);
				break;
				
			case 'goods':
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('q100'.$ObjectTypeInfo->getProductImgUrl());
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 关注 {module} 在线学习课程。';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->getProductName()</a>");

					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
				
					$setarr['body_data'] = array(
						'img_url' => $url,
					//	'img_src' => $img_src,
						'summary'=> $star_num,
						'people_board_id'=>$this->primaryKey,
					);
				break;
		}
		$setarr['title_data']=serialize($setarr['title_data']);
		$setarr['body_data']=serialize($setarr['body_data']);
		
		$model->attributes = $setarr;
		$model->save();
	}

	/*
	 * 随机一条测试
	 */
	public function randTest()
	{
		$testsuit = new TestSuit();
		$criteria = new CDbCriteria();
		$criteria->condition = 'is_delete = 0';
		$model = $testsuit->findAll($criteria);
		if (empty($model))
		{
			return null;
		}
		$randcount = mt_rand(0,count($model));
		return $model[$randcount]->primaryKey;
	}
}
