<?php

class area extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'area':
	 * @var integer $id
	 * @var string $title
	 * @var integer $pid
	 * @var integer $status
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
		return 'area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('pid, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
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
			'title' => 'Title',
			'pid' => 'Pid',
			'status' => 'Status',
		);
	}
	
	public function getList($pid='0') {
		//数据缓存
		$list = '';
		if(empty($list)){
			$list = $this->MakeTree($pid);
		}
		return $list;
	}	

	protected function MakeTree($pid,$level='1') {
		$criteria=new CDbCriteria;
		$criteria->condition = 'pid = :pid';
		$criteria->params = array(':pid'=>$pid);
		$result = $this->findAll($criteria);
		$list = array();
		if(!empty($result)){
			foreach ($result as $key => $value){
				$id = $value['id'];
				$list[$id]['id']    = $value['id'];
				$list[$id]['pid']    = $value['pid'];
				$list[$id]['title']  = $value['title'];
				$list[$id]['level']  = $level;
				$list[$id]['child'] = $this->MakeTree($value['id'],$level+1);
			}
		}
		return $list;
	}	
}
