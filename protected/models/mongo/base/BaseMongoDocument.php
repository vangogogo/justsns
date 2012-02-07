<?php

abstract class BaseMongoDocument extends EMongoDocument
{
	public function getDb()
	{
		 $dbc = $this->getMongoDBComponent();
        //使用hopecms 库
        $dbc->dbName = "hopecms";
        return $dbc->getDbInstance();
	}
	/**
	 * Returns the class name just as nornal.
	 *
	 * @static
	 * @param string $className
	 * @return
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function deleteMark()
	{
		$this->is_delete = 1;
        $this->delete_time = date('Y-m-d H:i:s');
		$this->save();
		return $this;
	}

	public function resetMark()
	{
		$this->is_delete = 0;
		$this->save();
		return $this;
	}
	/**
	* 获得model的类名
	*/
	public function getModelClass()
	{
		$modelclass = $this->getCollectionName();
		return $modelclass;
	}
}
