<?php

class WPeopleBoardForm extends Portlet
{
	//那个类型的rate
	public $object_type='';
	//指定到哪个id
	public $object_id = '';
	public $params = '';

	public $htmlOptions;
	public $title='';

	protected function renderContent()
	{
		//
		$params = $this->params;

		//提交到哪个action
		$data['action'] = Yii::app()->controller->createAbsoluteUrl('/board/create');

		$data['object_type'] = $params['object_type'];
		$data['object_id'] = $params['object_id'];

		$data['refer'] = $refer = Yii::app()->request->hostInfo.'/'.Yii::app()->request->pathInfo;
		$data['formhash'] = md5($data['object_type'].'|'.$data['object_id'].'|'.$data['refer']);

		$data['htmlOptions'] = $this->getClientOptions();

		$this->render('WPeopleBoardForm',$data);
	}

	/**
	 * @return array the javascript options for the star rating
	 */
	protected function getClientOptions()
	{
		$options = $this->htmlOptions;
		if(empty($options['seClassName']))
		{
			$options['seClassName'] = 'seBoard';
		}
		if(empty($options['seHeaderTitle']))
		{
			$options['headerTitle'] = '留言板';
		}
		if(empty($options['showSubmit']))
		{
			$options['showSubmit'] = true;
			$params = $this->params;

			if($params['object_type'] == 'mentor' OR $params['object_type'] == 'book')
			{
				$options['showSubmit'] = false;
			}
		}
		if(empty($options['id']))
		{
			$options['id'] = 'message-form';
		}
		return $options;
	}
}
