<?php
class WUserCollect extends CWidget
{
	public $object_type='';
	//指定到哪个id
	public $object_id = '';
	public $name ='';
	public $uid = '';

	/**
	 * @author :majc
	 * 页面渲染
	 */
	public function run()
	{
		$this->uid = Yii::app()->user->id;
		$data = $this->isCollect();
		$params = array(
			'isCollect'=>$data,
			'object_type' => $this->object_type,
			'object_id' => $this->object_id,
			'uid'=> $this->uid,
		);
		$this->render('WUserCollect',$params);
	}

	/**
	 * @author :majc
	 * 判断用户是否收藏
	 */
	protected function isCollect()
	{
		$params = array(
			'uid'=>$this->uid,
			'object_type' => $this->object_type,
			'object_id' => $this->object_id,
		); 

		$model = new PeopleContact();
        $co = $model->findByAttributes($params);

        if(!empty($co))
            return true;
        else
            return false;
	}
}
