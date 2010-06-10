<?php

/**
 * This is the model class for table "{{blog_source}}".
 *
 * The followings are the available columns in table '{{blog_source}}':
 * @property integer $id
 * @property string $service
 * @property string $username
 * @property integer $cTime
 * @property integer $lastSnap
 * @property integer $isNew
 * @property string $changes
 */
class BlogSource extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BlogSource the static model class
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
		return '{{blog_source}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cTime, lastSnap, isNew', 'numerical', 'integerOnly'=>true),
			array('service', 'length', 'max'=>10),
			array('username', 'length', 'max'=>30),
			array('changes', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service, username, cTime, lastSnap, isNew, changes', 'safe', 'on'=>'search'),
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
			'service' => 'Service',
			'username' => 'Username',
			'cTime' => 'C Time',
			'lastSnap' => 'Last Snap',
			'isNew' => 'Is New',
			'changes' => 'Changes',
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

		$criteria->compare('service',$this->service,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('cTime',$this->cTime);

		$criteria->compare('lastSnap',$this->lastSnap);

		$criteria->compare('isNew',$this->isNew);

		$criteria->compare('changes',$this->changes,true);

		return new CActiveDataProvider('BlogSource', array(
			'criteria'=>$criteria,
		));
	}
}