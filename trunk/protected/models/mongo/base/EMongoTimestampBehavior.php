<?php


class EMongoTimestampBehavior extends BaseMongoDocumentBehavior {
	/**
	* @var mixed The name of the attribute to store the creation time.  Set to null to not
	* use a timstamp for the creation attribute.  Defaults to 'create_time'
	*/
	public $createAttribute = 'create_time';
	/**
	* @var mixed The name of the attribute to store the modification time.  Set to null to not
	* use a timstamp for the update attribute.  Defaults to 'update_time'
	*/
	public $updateAttribute = 'update_time';

	/**
	* @var bool Whether to set the update attribute to the creation timestamp upon creation.
	* Otherwise it will be left alone.  Defaults to false.
	*/
	public $setUpdateOnCreate = false;

	/**
	* @var mixed The expression that will be used for generating the timestamp.
	* This can be either a string representing a PHP expression (e.g. 'time()'),
	* or a {@link CDbExpression} object representing a DB expression (e.g. new CDbExpression('NOW()')).
	* Defaults to null, meaning that we will attempt to figure out the appropriate timestamp
	* automatically. If we fail at finding the appropriate timestamp, then it will
	* fall back to using the current UNIX timestamp
	*/
	public $timestampExpression;

	/**
	* @var array Maps column types to database method
	*/
	protected static $map = array(
			'datetime'=>'NOW()',
			'timestamp'=>'NOW()',
			'date'=>'NOW()',
	);

	/**
	* Responds to {@link CModel::onBeforeSave} event.
	* Sets the values of the creation or modified attributes as configured
	*
	* @param CModelEvent $event event parameter
	*/
	public function beforeToArray($event) {
		if ($this->getOwner()->getScenario() == 'insert' && ($this->createAttribute !== null)) {
			$this->getOwner()->{$this->createAttribute} = $this->getTimestampByAttribute($this->createAttribute);
		}

		if ((!($this->getOwner()->getScenario() == 'insert') || $this->setUpdateOnCreate) && ($this->updateAttribute !== null)) {
			$this->getOwner()->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
		}
	}

	/**
	* Gets the approprate timestamp depending on the column type $attribute is
	*
	* @param string $attribute $attribute
	* @return mixed timestamp (eg unix timestamp or a mysql function)
	*/
	protected function getTimestampByAttribute($attribute) {
		if ($this->timestampExpression instanceof CDbExpression)
			return $this->timestampExpression;
		else if ($this->timestampExpression !== null)
			return @eval('return '.$this->timestampExpression.';');
        return date('Y-m-d H:i:s');
		$columnType = $this->getOwner()->getTableSchema()->getColumn($attribute)->dbType;
		return $this->getTimestampByColumnType($columnType);
	}

	/**
	* Returns the approprate timestamp depending on $columnType
	*
	* @param string $columnType $columnType
	* @return mixed timestamp (eg unix timestamp or a mysql function)
	*/
	protected function getTimestampByColumnType($columnType) {
		return isset(self::$map[$columnType]) ? new CDbExpression(self::$map[$columnType]) : time();
	}
}
