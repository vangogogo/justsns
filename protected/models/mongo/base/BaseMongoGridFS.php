<?php

abstract class BaseMongoGridFS extends EMongoGridFS
{
	public function getDb()
	{
		 $dbc = $this->getMongoDBComponent();
        //使用hopecms 库
        $dbc->dbName = "hopecms";
        return $dbc->getDbInstance();
	}
}
