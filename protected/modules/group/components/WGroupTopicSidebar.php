<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 */
class WGroupTopicSidebar extends CWidget
{
	public $gid;
	public function run()
	{
		$gid = $this->gid;
		$group = Group::model()->loadGroup($gid);
		$new_topics = $group->getGroupNewThreads();
		$data = array(
			'group'=>$group,
			'new_topics'=>$new_topics,
		);
		$this->render('WGroupTopicSidebar',$data);
	}
}
