<?php

class WPeopleBoard extends Portlet
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
		//登录
		$params = $this->params;


		$model = new PeopleBoard();
		$data = $model->findAllData($params);
		$data['more_link'] = $params['more_link'];
		$data['htmlOptions'] = $this->getClientOptions();
		if($params['object_type'] == 'mentor')
		{
			$lecturer_id = $params['object_id'];
			$data['isUserReply'] = PeopleBoard::model()->isUserReply($lecturer_id);
			$data['action'] = $this->controller->createUrl('ajax/boardReply');
		}
		$this->render('WPeopleBoard',$data);
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
		return $options;
	}
}