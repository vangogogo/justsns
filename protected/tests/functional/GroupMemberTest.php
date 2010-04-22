<?php

class GroupMemberTest extends WebTestCase
{
	public $fixtures=array(
		'groupMembers'=>'GroupMember',
	);

	public function testShow()
	{
		$this->open('?r=groupMember/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=groupMember/create');
	}

	public function testUpdate()
	{
		$this->open('?r=groupMember/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=groupMember/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=groupMember/index');
	}

	public function testAdmin()
	{
		$this->open('?r=groupMember/admin');
	}
}
