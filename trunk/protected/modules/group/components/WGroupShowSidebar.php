<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WGroupShowSidebar extends CWidget
{
	public $gid;
	public function run()
	{
		$gid = $this->gid;
		$group = Group::model()->loadGroup($gid);
		//友情小租
		//$friend_groups = $group->getGroupNewFriends();
		//最近加入
		$group_members = $group->getGroupNewMembers();

		$data = array(
			'group'=>$group,
			'group_list'=>$group_list,
		);
		$this->render('WGroupShowSidebar',$data);
	}
}