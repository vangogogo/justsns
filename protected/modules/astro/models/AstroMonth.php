<?php

/**
 * This is the model class for table "{{astro_month}}".
 *
 * The followings are the available columns in table '{{astro_month}}':
 * @property integer $astro_month_id
 * @property integer $astro_id
 * @property string $month
 * @property string $author
 * @property string $content
 * @property integer $sum
 * @property integer $love
 * @property integer $work
 * @property integer $money
 * @property integer $study
 * @property string $sum_content
 * @property string $study_content
 * @property string $work_content
 * @property string $money_content
 * @property string $love_content
 * @property string $relax_way
 * @property string $luck_way
 * @property string $ctime
 */
class AstroMonth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AstroMonth the static model class
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
		return '{{astro_month}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('astro_id, month, author, content, sum, love, work, money, study, sum_content, study_content, work_content, money_content, love_content, relax_way, luck_way, ctime', 'required'),
			array('astro_id, sum, love, work, money, study', 'numerical', 'integerOnly'=>true),
			array('month', 'length', 'max'=>6),
			array('author', 'length', 'max'=>20),
			array('relax_way, luck_way', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('astro_month_id, astro_id, month, author, content, sum, love, work, money, study, sum_content, study_content, work_content, money_content, love_content, relax_way, luck_way, ctime', 'safe', 'on'=>'search'),
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
			'astro_month_id' => 'Astro Month',
			'astro_id' => 'Astro',
			'month' => 'Month',
			'author' => 'Author',
			'content' => 'Content',
			'sum' => 'Sum',
			'love' => 'Love',
			'work' => 'Work',
			'money' => 'Money',
			'study' => 'Study',
			'sum_content' => 'Sum Content',
			'study_content' => 'Study Content',
			'work_content' => 'Work Content',
			'money_content' => 'Money Content',
			'love_content' => 'Love Content',
			'relax_way' => 'Relax Way',
			'luck_way' => 'Luck Way',
			'ctime' => 'Ctime',
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

		$criteria->compare('astro_month_id',$this->astro_month_id);
		$criteria->compare('astro_id',$this->astro_id);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('sum',$this->sum);
		$criteria->compare('love',$this->love);
		$criteria->compare('work',$this->work);
		$criteria->compare('money',$this->money);
		$criteria->compare('study',$this->study);
		$criteria->compare('sum_content',$this->sum_content,true);
		$criteria->compare('study_content',$this->study_content,true);
		$criteria->compare('work_content',$this->work_content,true);
		$criteria->compare('money_content',$this->money_content,true);
		$criteria->compare('love_content',$this->love_content,true);
		$criteria->compare('relax_way',$this->relax_way,true);
		$criteria->compare('luck_way',$this->luck_way,true);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}