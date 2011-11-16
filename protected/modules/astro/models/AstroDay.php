<?php

/**
 * This is the model class for table "{{astro_day}}".
 *
 * The followings are the available columns in table '{{astro_day}}':
 * @property integer $astro_day_id
 * @property integer $astro_id
 * @property string $day
 * @property string $author
 * @property string $content
 * @property integer $sum
 * @property integer $love
 * @property integer $work
 * @property integer $money
 * @property integer $health
 * @property integer $bussiness
 * @property string $luck_color
 * @property integer $luck_num
 * @property string $luck_astro
 * @property string $ctime
 */
class AstroDay extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AstroDay the static model class
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
		return '{{astro_day}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('astro_id, day, author, content, sum, love, work, money, health, bussiness, luck_color, luck_num, luck_astro, ctime', 'required'),
			array('astro_id, sum, love, work, money, health, bussiness, luck_num', 'numerical', 'integerOnly'=>true),
			array('day', 'length', 'max'=>8),
			array('author', 'length', 'max'=>20),
			array('luck_color, luck_astro', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('astro_day_id, astro_id, day, author, content, sum, love, work, money, health, bussiness, luck_color, luck_num, luck_astro, ctime', 'safe', 'on'=>'search'),
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
			'astro_day_id' => 'Astro Day',
			'astro_id' => 'Astro',
			'day' => 'Day',
			'author' => 'Author',
			'content' => 'Content',
			'sum' => 'Sum',
			'love' => 'Love',
			'work' => 'Work',
			'money' => 'Money',
			'health' => 'Health',
			'bussiness' => 'Bussiness',
			'luck_color' => 'Luck Color',
			'luck_num' => 'Luck Num',
			'luck_astro' => 'Luck Astro',
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

		$criteria->compare('astro_day_id',$this->astro_day_id);
		$criteria->compare('astro_id',$this->astro_id);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('sum',$this->sum);
		$criteria->compare('love',$this->love);
		$criteria->compare('work',$this->work);
		$criteria->compare('money',$this->money);
		$criteria->compare('health',$this->health);
		$criteria->compare('bussiness',$this->bussiness);
		$criteria->compare('luck_color',$this->luck_color,true);
		$criteria->compare('luck_num',$this->luck_num);
		$criteria->compare('luck_astro',$this->luck_astro,true);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
