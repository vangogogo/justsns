<?php

/**
 * This is the model class for table "{{star_rate_log}}".
 *
 * The followings are the available columns in table '{{star_rate_log}}':
 * @property integer $star_rate_id
 * @property integer $user_id
 * @property string $object_type
 * @property integer $object_id
 * @property integer $star_num
 * @property string $ip
 * @property string $mtime
 * @property string $ctime
 * @property integer $is_delete
 */
class StarRateLog extends YiicmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StarRateLog the static model class
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
		return '{{star_rate_log}}';
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
			array('user_id, object_id, star_num, is_delete', 'numerical', 'integerOnly'=>true),
			array('object_type', 'length', 'max'=>20),
			array('ip', 'length', 'max'=>255),
			array('mtime, ctime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('star_rate_id, user_id, object_type, object_id, star_num, ip, mtime, ctime, is_delete', 'safe', 'on'=>'search'),
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
			'star_rate_id' => Yii::t('admin','Star Rate'),
			'user_id' => Yii::t('admin','User'),
			'object_type' => Yii::t('admin','Object Type'),
			'object_id' => Yii::t('admin','Object'),
			'star_num' => Yii::t('admin','Star Num'),
			'ip' => Yii::t('admin','Ip'),
			'mtime' => Yii::t('admin','Update Time'),
			'ctime' => Yii::t('admin','Create Time'),
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

		$criteria->compare('star_rate_id',$this->star_rate_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('star_num',$this->star_num);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('mtime',$this->mtime,true);
		$criteria->compare('ctime',$this->ctime,true);
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
    public function findAllData($params = array())
    {
        $criteria = new CDbCriteria;
        $criteria->condition = ' is_delete = 0 ';
		$criteria->order = 'ctime DESC';
        if(!empty($params))
        {
			$criteria->compare('user_id',$params['user_id']);
			$criteria->compare('object_type',$params['object_type']);
			$criteria->compare('object_id',$params['object_id']);
			$criteria->compare('star_num',$params['star_num']);
        }

        if(!empty($params['page']))
        {
            $_GET['page'] = $params['page'];
        }
		$model = self::model();


		if(!empty($params['limit']))
		{
			$criteria->limit = $params['limit'];
		}
		else
		{
			// 分页
			$pageSize = $params['pageSize']?$params['pageSize']:self::PAGE_SIZE;
			$total= $model->count($criteria);
			$pages=new CPagination($total);
			$pages->pageSize=$pageSize;
			$pagecount = ceil($total/$pageSize);
			$pages->applyLimit($criteria);
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

	/**
	 * 插入用户的评分信息
	 */
	public function insertUserStar($params)
	{
		$model = new StarRateLog();
		$model->user_id=$params['user_id'];
		$model->object_type=$params['object_type'];
		$model->object_id=$params['object_id'];
		$model->star_num=$params['star_num'];
		$model->save();
	}
	
	/**
	 * 更新用户的评分信息
	 */
	public function updateUserStar($star_info,$params)
	{
		$star_info->star_num=$params['star_num'];
		$star_info->save();
	}
	/**
	 * 判断用户是否有过评分信息
	 */
	public function isExist($params)
	{
		$model = new StarRateLog();
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id AND object_type=:object_type AND object_id=:object_id';
		$criteria->params=array(
			':user_id'=>$params['user_id'],
			':object_type'=>$params['object_type'],
			':object_id'=>$params['object_id'],
		);
		$post=$model->count($criteria);
		if($post>=1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * 判断用户是否有过评分,true就更新数据,falas插入数据
	 */
	public function setRateInfo($params)
	{
		if(empty($params))
		{
			$params['user_id'] = Yii::app()->user->id;
		}
		//检查是否有投票记录
		$isExist = $this->isExist($params);
		if($isExist==true)
		{
			//将投票记录查询出来
			$star_info = $this->findRateInfo($params);
			$this->updateUserStar($star_info,$params);
		}
		else
		{
			//直接插入
			$star_info = $this->insertUserStar($params);
		}
		return $star_info;
	}

	/**
	 * 查找当前用户的评分信息
	 */
	public function findRateInfo($params)
	{
		$model = new StarRateLog();
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id AND object_type=:object_type AND object_id=:object_id';
		$criteria->params=array(
			':user_id'=>$params['user_id'],
			':object_type'=>$params['object_type'],
			':object_id'=>$params['object_id'],
		);

		return $model->find($criteria);
	}
	
}
