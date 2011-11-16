<?php

/**
 * This is the model class for table "astro".
 *
 * The followings are the available columns in table 'astro':
 * @property integer $astro_id
 * @property string $astro_name
 * @property string $astro_name_en
 * @property string $astro_date
 * @property string $astro_desc
 * @property integer $ex1
 * @property integer $ex2
 * @property integer $ex3
 * @property integer $ex4
 * @property integer $ex5
 * @property integer $ex6
 * @property integer $ex7
 * @property integer $ex8
 */
class Astro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Astro the static model class
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
		return '{{astro}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('astro_name, astro_name_en, astro_date, astro_desc', 'required'),
			array('ex1, ex2, ex3, ex4, ex5, ex6, ex7, ex8', 'numerical', 'integerOnly'=>true),
			array('astro_name, astro_name_en, astro_date', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('astro_id, astro_name, astro_name_en, astro_date, astro_desc, ex1, ex2, ex3, ex4, ex5, ex6, ex7, ex8', 'safe', 'on'=>'search'),
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

    public function behaviors()
    {
        return array(
            array(
                'class'=>'ext.seo.components.SeoRecordBehavior',
                'route'=>'astro/default/astro',
                'params'=>array('astro_id'=>$this->astro_id, 'name'=>$this->astro_name_en),
            ),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'astro_id' => 'Astro',
			'astro_name' => 'Astro Name',
			'astro_name_en' => 'Astro Name En',
			'astro_date' => 'Astro Date',
			'astro_desc' => 'Astro Desc',
			'ex1' => 'Ex1',
			'ex2' => 'Ex2',
			'ex3' => 'Ex3',
			'ex4' => 'Ex4',
			'ex5' => 'Ex5',
			'ex6' => 'Ex6',
			'ex7' => 'Ex7',
			'ex8' => 'Ex8',
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

		$criteria->compare('astro_id',$this->astro_id);
		$criteria->compare('astro_name',$this->astro_name,true);
		$criteria->compare('astro_name_en',$this->astro_name_en,true);
		$criteria->compare('astro_date',$this->astro_date,true);
		$criteria->compare('astro_desc',$this->astro_desc,true);
		$criteria->compare('ex1',$this->ex1);
		$criteria->compare('ex2',$this->ex2);
		$criteria->compare('ex3',$this->ex3);
		$criteria->compare('ex4',$this->ex4);
		$criteria->compare('ex5',$this->ex5);
		$criteria->compare('ex6',$this->ex6);
		$criteria->compare('ex7',$this->ex7);
		$criteria->compare('ex8',$this->ex8);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getAstroDayInfo($day = '')
    {
        if(empty($day))
            $day = date('Ymd');

	    $criteria = new CDbCriteria;
	    $criteria->condition = 'astro_id = :astro_id AND day = :day';
        $criteria->params = array(':astro_id'=>$this->astro_id,':day'=>$day);
        $astros = AstroDay::model()->find($criteria);
		if(empty($astros))
		{
			$astros = new AstroDay();
		}
        return $astros;
    }

    public function getAstroWeekInfo($day = '')
    {
        if(empty($day))
            $day = date('Ymd');

	    $criteria = new CDbCriteria;
	    $criteria->condition = 'astro_id = :astro_id AND day_start <= :day AND day_end >= :day';
        $criteria->params = array(':astro_id'=>$this->astro_id,':day'=>$day);

        $astros = AstroWeek::model()->find($criteria);
		if(empty($astros))
		{
			$astros = new AstroWeek();
		}
        return $astros;
    }

    public function getAstroMonthInfo($month = '')
    {
        if(empty($month))
            $month = date('Ym');

	    $criteria = new CDbCriteria;
	    $criteria->condition = 'astro_id = :astro_id AND month = :month';
        $criteria->params = array(':astro_id'=>$this->astro_id,':month'=>$month);

        $astros = AstroMonth::model()->find($criteria);
        return $astros;
    }
}
