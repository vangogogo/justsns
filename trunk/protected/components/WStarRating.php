<?php

class WStarRating extends CStarRating
{
	//那个类型的rate
	public $object_type='';
	//指定到哪个id
	public $object_id = '';

	public $allowEmpty = false;

	public function init()
	{
		parent::init();
		if(Yii::app()->request->isAjaxRequest)
		{
			$cs=Yii::app()->clientScript;
			$cs->scriptMap=array(
				'jquery.js'=>false,
			);
		}
        if(empty($this->name))
        {
            $this->name = 'StarRating_'.$this->object_type.'_'.$this->object_id;
        }

		if($this->readOnly)
		{
			$this->allowEmpty = false;
		}
		//如果为只读，则不加载默认callback
		if(!$this->readOnly)
		{
			$rate_num = $this->value;
			//根据id和id_type,user_id 去查询 star_rate_log
			$model = new StarRateLog();
			$params['user_id'] = Yii::app()->user->id;
			$params['object_id'] = $this->object_id;
			$params['object_type'] = $this->object_type;
			//$id = $this->id;
			$info = $model->findRateInfo($params);
			if(!empty($info))
				$rate_num = $info['star_num'];
			$this->value = $rate_num;
			$this->callback = $this->getDefaultCallBack();
		}

	}

	private function getDefaultCallBack()
	{
		if(!empty($this->callBack))
		{
			return $this->callBack;
		}
		if(Yii::app()->user->isGuest)
		{
			$callBack = 'function(){_cklogin()}';

			return $callBack;
		}
		$callBack = '
        function(){
        $.ajax({
            type: "POST",
            url: "'.$this->controller->createUrl('Ajax/StarRating').'",
            data: "object_id='.$this->object_id.'&object_type='.$this->object_type.'&rate=" + $(this).val(),
            success: function(msg){
                Alert( "感谢您的投票！ " + msg
            )
        }})}';

		return $callBack;
	}

}
