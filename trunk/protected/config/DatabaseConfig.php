<?php
class DatabaseConfig
{
	static function dbInfo()
	{
		return array(
			'class'=>'CDbConnection',
			'connectionString'=>'mysql:host=localhost;port=3306;dbname=yiisns',
			'username'=>'root',
			'password'=>'111111',
			'charset' => 'utf8',
			'enabled' => true,
			'tablePrefix'=>'yiisns_',
		);
	}
}
