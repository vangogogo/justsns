<?php

/**
 * This is the model class for table "{{people_board}}".
 *
 * The followings are the available columns in table '{{people_board}}':
 * @property integer $board_id
 * @property integer $uid
 * @property string $object_type
 * @property integer $object_id
 * @property string $name
 * @property string $board_content
 * @property integer $view_count
 * @property string $ctime
 * @property string $mtime
 * @property integer $is_delete
 */
class PeopleBoard extends YiicmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PeopleBoard the static model class
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
		return '{{people_board}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, object_type, object_id, name, board_content', 'required'),
			array('uid, object_id, view_count, is_delete', 'numerical', 'integerOnly'=>true),
			array('object_type', 'length', 'max'=>20),
			array('name', 'length', 'max'=>50),
			array('mtime, ctime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('board_id, uid, object_type, object_id, name, board_content, view_count, ctime, mtime, is_delete', 'safe', 'on'=>'search'),
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
			'board_id' => Yii::t('admin','Board'),
			'uid' => Yii::t('admin','User'),
			'object_type' => Yii::t('admin','Object Type'),
			'object_id' => Yii::t('admin','Object'),
			'name' => Yii::t('admin','User Name'),
			'board_content' => Yii::t('admin','Board Content'),
			'view_count' => Yii::t('admin','View Count'),
			'ctime' => Yii::t('admin','Create Time'),
			'mtime' => Yii::t('admin','Update Time'),
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

		$criteria->compare('board_id',$this->board_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('board_content',$this->board_content,true);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);
		$criteria->compare('is_delete',$this->is_delete);
		if($this->is_delete == NULL)
		{
			$criteria->compare('is_delete',0);
		}


		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    /**
     * 获得数据集
     * @param array $params
     */
    public function findAllData($params = array(),$limit = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = ' is_delete = 0 ';

        if(!empty($params))
        {
			$arr = array('uid','object_type','object_id','name');
			foreach($arr as $attr)
			{
				if(isset($params[$attr]))
					$criteria->compare($attr,$params[$attr]);
			}
        }
		if(empty($params['order']))
		{
			$criteria->order = 'ctime DESC';
		}
        if(!empty($params['page']))
        {
            $_GET['page'] = $params['page'];
        }
		$model = self::model();
		$total= $model->count($criteria);
		if(!empty($params['limit']))
		{
			$criteria->limit = $params['limit'];
			$pagecount = 0;
			$pages = null;
		}
		else
		{
			// 分页
			$pageSize = $params['pageSize']?$params['pageSize']:self::PAGE_SIZE;
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize;
			$pagecount = ceil($total/$pageSize);
			$pages->applyLimit($criteria);
		}
    	if(!empty($params['#']))
		{	
			$page_params = $_GET;
			$page_params['#'] = $params['#'];
			$pages->params = $page_params;			
		}
		
        // 排序
        $sort=new CSort($model);
        $sort->applyOrder($criteria);

        $models = $model->findAll($criteria);

        $data = array(
            'models'=>$models,
            'total'=>$total,
            'pagecount'=>$pagecount,
            'pages'=>$pages,
            'sort'=>$sort,
        );
        return $data;
    }
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->uid=Yii::app()->user->id;
			$time = time();
			$this->ctime= date('Y-m-d H:i:s');
			
			$user = User::model()->findByPk($this->uid);
			if(empty($user))
			{
				//提示没有这个用户
			}
			else
			{
				$this->name = $user->username;
			}
		}
		else
			$this->mtime= date('Y-m-d H:i:s');
		return true;
	}
    /**
     * 判断当前用户能否回复留言
     */
    
	public function isUserReply($lecturer_id)
	{
		$uid = Yii::app()->user->id;
		if(Yii::app()->user->isGuest || empty($uid))
		{
			return false;
		}	
        
		//$find_lecturer_userid = Lecturer::model()->loadLecturer($lecturer_id);
		//$lecturer_userid = $find_lecturer_userid->uid;
		
		if($lecturer_userid == $uid)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * 查找某个对象留言信息(书籍、视频、导师)
	 */
	public function findPeopleBoard($params)
	{
		if (empty($params))
		{
			return null;
		}
		$criteria = new CDbCriteria();
		$criteria -> condition = 'object_type = :object_type AND object_id = :object_id';
		$criteria -> params = array(
			':object_type' => $params['object_type'],
			':object_id' => $params['object_id'],
		);
		
		$model = PeopleBoard::model()->find($criteria);
		return $model;
	}
	/*
	* 检查当前用户是否该留言的管理者。如导师。。
	*/
	public function isManager()
	{
		if($this->object_type == 'mentor')
		{
			$lecturer_id = $this->object_id;
			return $this->isUserReply($lecturer_id);
		}
		return false;
	}

	/*
	* 检查是否当前用户的发布
	*/
	public function isMyBoard()
	{
		return Yii::app()->user->id == $this->uid;
	}
	
	/*
	* 检查用户是否可以删除本留言
	*/
	public function isDeleteAccess()
	{
		//当导师未回复前，发表者允许删除，
		if(empty($this->board_reply) AND $this->isMyBoard() )
		{
			return true;
		}
		
		if($this->isManager())
		{
			return true;
		}
		return false;
	}
	
	/**
	 * @author:majc
	 * 在uchome 保存留言的动态信息
	 */
	public function afterSave2()
	{
		parent::afterSave();
		$model = new UchomeFeed();
		//后台判断是否显示动态
		if (!$model->isShowFeed()) {
			return null;
		}
		$object_type = $this->object_type;
		$object_id = $this->object_id;
		$uid = Yii::app()->user->id;
		$username = Yii::app()->user->name;
		$dateline = strtotime("now");
		$board_content = cutString($this->board_content, 150);
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
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('mentor'.$ObjectTypeInfo->lecturer_pic);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 给 {module} 导师留言了';
					$setarr['title_data'] = array('module' => "<a href=\"$url\">$ObjectTypeInfo->lecturer_name</a>");
					
					$setarr['body_template'] = '<a href="{img_url}"></a> {summary}';
					$setarr['body_data'] = array(
						'img_url' => $url,
				//		'img_src' => $ObjectTypeInfo->lecturer_pic,
						'summary'=>$board_content,
						'people_board_id'=>$this->primaryKey,
					);
				break;

			case 'za_article':
					$Magazine_info = MagazineMagazine::model()->findByPk($ObjectTypeInfo->magazine_id);
					$setarr['image_1'] = Yii::app()->createAbsoluteUrl('magazine'.$Magazine_info->magazine_small_pic);
					$setarr['image_1_link'] = $url;

					$setarr['title_template'] = '{actor} 给 {module} 杂志留言了';
					$issueUrl = Yii::app()->createAbsoluteUrl('magazine/default/issue',array('id' =>$Magazine_info->magazine_id));
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

					$setarr['title_template'] = '{actor} 给 {module} 书籍留言了';
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

					$setarr['title_template'] = '{actor} 给 {module} 视频留言了';
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
					$setarr['title_template'] = '{actor} 给 {module} 课程留言了';
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

					$setarr['title_template'] = '{actor} 给 {module} 在线学习课程留言了。';
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


}
