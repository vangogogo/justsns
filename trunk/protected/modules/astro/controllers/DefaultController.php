<?php

class DefaultController extends Controller
{
	#public $layout='//layouts/column2';

    public function behaviors()
    {
        return array(
            'seo'=>array('class'=>'ext.seo.components.SeoControllerBehavior'),
        );
    }

    public function init()
    {
	    $m_astro = new m_astro;
        $astros = $m_astro->getAstrosList();

        if(!empty($astros))
        {
			$keywords = '';
            foreach($astros as $tmp)
            {
                $keywords .= $tmp->astro_name.',';
            }
            foreach($astros as $tmp)
            {
                $keywords .= $tmp->astro_name_en.',';
            }
            $keywords .= '十二星座,astro';
        }
        $this->metaKeywords = $keywords;
        $this->metaDescription = $keywords.'最新,最准确,爱情,学习,健康,幸运,对象';
        return true;
    }

	public function actionIndex()
	{
	    $m_astro = new m_astro;
        $astros = $m_astro->getAstrosList();

        if(!empty($astros))
        {
			$keywords = '';
            foreach($astros as $tmp)
            {
                $keywords .= $tmp->astro_name.',';
            }
            foreach($astros as $tmp)
            {
                $keywords .= $tmp->astro_name_en.',';
            }
            $keywords .= '十二星座,astro';
        }
        $this->metaKeywords = $keywords;
        $this->metaDescription = $keywords.'最新,最准确,爱情,学习,健康,幸运,对象';

		$this->render('index',array('astros'=>$astros));
	}

	public function actionAstro()
	{
        $id = $_GET['astro_id'];
	    $m_astro = new m_astro;
        $astro = $m_astro->getAstroInfo($id);

        $d_day = @$_GET['year'].@$_GET['month'].@$_GET['day'];
        if(empty($d_day))
        {
            $d_day = date('Ymd');
        }
        $d_month = substr($d_day,0,6);

        $day = $astro->getAstroDayInfo($d_day);
        $week = $astro->getAstroWeekInfo($d_day);
        $month = $astro->getAstroMonthInfo($d_month);

        $this->pageTitle = array(
            $astro->astro_name.''.$astro->astro_name_en,
            $week->content,
            '星座起源 astro 最准确',
        ); 

        $data = array(
            'day'=>$day,
            'month'=>$month,
            'week'=>$week,
            'astro'=>$astro,
            'd_day'=>$d_day,
        );
		$this->render('astro',$data);
	}
}
