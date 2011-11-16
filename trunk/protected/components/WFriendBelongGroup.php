<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WFriendBelongGroup extends CWidget
{
	public $items=array();
	public $fuid ;
    public $relation;

	public function run()
	{

		$uid = Yii::app()->user->id;
        $fuid = $this->fuid;

        //
		$friendGroup = Friend::model()->getFriendGroups($uid);

		if(!empty($friendGroup)) 
            $groups_arr = CHtml::listData($friendGroup, 'id', 'name');

        $relation = $this->relation;
        $fuid = $relation->fuid;
        $list = $relation->frienBelongdGroup;
        

		$frienBelongdGroup = array();
		if(!empty($list))
		{
			foreach($list as $key => $value)
			{
				$frienBelongdGroup[$value['gid']] = $groups_arr[$value['gid']];
			}
		}



		$data = array(
			'frienBelongdGroup' => $frienBelongdGroup,
			'groups_arr' => $groups_arr,
            'friendGroup'=>$friendGroup,
            'fuid'=>$fuid,
		);

		$this->render('WFriendBelongGroup',$data);
	}
}
