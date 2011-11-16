<?php

/**
 * This is the model class for table "{{astro_week}}".
 *
 * The followings are the available columns in table '{{astro_week}}':
 * @property integer $astro_week_id
 * @property integer $astro_id
 * @property string $day
 * @property string $day_start
 * @property string $day_end
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
 * @property integer $love_no
 * @property string $love_content_no
 * @property integer $sex
 * @property string $sex_content
 * @property string $red
 * @property string $red_content
 * @property string $black
 * @property string $black_content
 * @property string $ctime
 */
class AstroWeek extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AstroWeek the static model class
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
		return '{{astro_week}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('astro_id, day, day_start, day_end, author, content, sum, love, work, money, study, sum_content, study_content, work_content, money_content, love_content, love_no, love_content_no, sex, sex_content, red, red_content, black, black_content, ctime', 'required'),
			array('astro_id, sum, love, work, money, study, love_no, sex', 'numerical', 'integerOnly'=>true),
			array('day, day_start, day_end', 'length', 'max'=>8),
			array('author', 'length', 'max'=>20),
			array('red, black', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('astro_week_id, astro_id, day, day_start, day_end, author, content, sum, love, work, money, study, sum_content, study_content, work_content, money_content, love_content, love_no, love_content_no, sex, sex_content, red, red_content, black, black_content, ctime', 'safe', 'on'=>'search'),
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
			'astro_week_id' => 'Astro Week',
			'astro_id' => 'Astro',
			'day' => 'Day',
			'day_start' => 'Day Start',
			'day_end' => 'Day End',
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
			'love_no' => 'Love No',
			'love_content_no' => 'Love Content No',
			'sex' => 'Sex',
			'sex_content' => 'Sex Content',
			'red' => 'Red',
			'red_content' => 'Red Content',
			'black' => 'Black',
			'black_content' => 'Black Content',
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

		$criteria->compare('astro_week_id',$this->astro_week_id);
		$criteria->compare('astro_id',$this->astro_id);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('day_start',$this->day_start,true);
		$criteria->compare('day_end',$this->day_end,true);
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
		$criteria->compare('love_no',$this->love_no);
		$criteria->compare('love_content_no',$this->love_content_no,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('sex_content',$this->sex_content,true);
		$criteria->compare('red',$this->red,true);
		$criteria->compare('red_content',$this->red_content,true);
		$criteria->compare('black',$this->black,true);
		$criteria->compare('black_content',$this->black_content,true);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}