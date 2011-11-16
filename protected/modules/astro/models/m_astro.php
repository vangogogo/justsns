<?php


class m_astro
{
    public function getAstrosList()
    {

	        $criteria = new CDbCriteria;
	        $criteria->order = 'astro_id DESC';
	        $criteria->limit = '12';
            $astros = Astro::model()->findAll($criteria);
            return $astros;

        $key = 'getAstrosList';
        $astros = Yii::app()->cache->get($key);
        if(empty($astros))
        {
	        $criteria = new CDbCriteria;
	        $criteria->order = 'astro_id DESC';
	        $criteria->limit = '12';
            $astros = Astro::model()->findAll($criteria);

            Yii::app()->cache->set($key, $astros);
        }
        return $astros;
    }

    public function getAstroInfo($astro_id)
    {
        $astro = Astro::model()->findByPk($astro_id);
        return $astro;
    }

    public function getAstroDayInfo($astro_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->order = 'astro_id DESC';
	    $criteria->limit = '12';
        $astros = Astro::model()->findAll($criteria);
        return $astros;
    }

    public function getAstroWeekInfo($astro_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->order = 'astro_id DESC';
	    $criteria->limit = '12';
        $astros = Astro::model()->findAll($criteria);
        return $astros;
    }

    public function getAstroMonthInfo($astro_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->order = 'astro_id DESC';
	    $criteria->limit = '12';
        $astros = Astro::model()->findAll($criteria);
        return $astros;
    }
}

