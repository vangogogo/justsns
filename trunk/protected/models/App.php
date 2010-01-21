<?php

class App extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'app':
	 * @var integer $id
	 * @var string $name
	 * @var string $enname
	 * @var string $icon
	 * @var string $url
	 * @var string $url_exp
	 * @var string $url_admin
	 * @var string $uid_url
	 * @var string $add_url
	 * @var string $add_name
	 * @var string $author
	 * @var string $description
	 * @var integer $order2
	 * @var integer $place
	 * @var integer $status
	 * @var string $canvas_url
	 * @var integer $type
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
		return 'app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order2, place, status, type', 'numerical', 'integerOnly'=>true),
			array('name, uid_url, add_url, add_name, author, canvas_url', 'length', 'max'=>255),
			array('enname', 'length', 'max'=>150),
			array('icon, url, url_exp, url_admin, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, enname, icon, url, url_exp, url_admin, uid_url, add_url, add_name, author, description, order2, place, status, canvas_url, type', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'enname' => 'Enname',
			'icon' => 'Icon',
			'url' => 'Url',
			'url_exp' => 'Url Exp',
			'url_admin' => 'Url Admin',
			'uid_url' => 'Uid Url',
			'add_url' => 'Add Url',
			'add_name' => 'Add Name',
			'author' => 'Author',
			'description' => 'Description',
			'order2' => 'Order2',
			'place' => 'Place',
			'status' => 'Status',
			'canvas_url' => 'Canvas Url',
			'type' => 'Type',
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

		if($this->id!='')
		{
			$criteria->addCondition('id=:id');
			$criteria->params[':id']=$this->id;
		}
		if($this->name!='')
			$criteria->addSearchCondition('name',$this->name);

		if($this->enname!='')
			$criteria->addSearchCondition('enname',$this->enname);

		if($this->icon!='')
			$criteria->addSearchCondition('icon',$this->icon);

		if($this->url!='')
			$criteria->addSearchCondition('url',$this->url);

		if($this->url_exp!='')
			$criteria->addSearchCondition('url_exp',$this->url_exp);

		if($this->url_admin!='')
			$criteria->addSearchCondition('url_admin',$this->url_admin);

		if($this->uid_url!='')
			$criteria->addSearchCondition('uid_url',$this->uid_url);

		if($this->add_url!='')
			$criteria->addSearchCondition('add_url',$this->add_url);

		if($this->add_name!='')
			$criteria->addSearchCondition('add_name',$this->add_name);

		if($this->author!='')
			$criteria->addSearchCondition('author',$this->author);

		if($this->description!='')
			$criteria->addSearchCondition('description',$this->description);

		if($this->order2!='')
		{
			$criteria->addCondition('order2=:order2');
			$criteria->params[':order2']=$this->order2;
		}
		if($this->place!='')
		{
			$criteria->addCondition('place=:place');
			$criteria->params[':place']=$this->place;
		}
		if($this->status!='')
		{
			$criteria->addCondition('status=:status');
			$criteria->params[':status']=$this->status;
		}
		if($this->canvas_url!='')
			$criteria->addSearchCondition('canvas_url',$this->canvas_url);

		if($this->type!='')
		{
			$criteria->addCondition('type=:type');
			$criteria->params[':type']=$this->type;
		}
		return new CActiveDataProvider('App', array(
			'criteria'=>$criteria,
		));
	}
}