<?php
class DatabaseConfig
{
	static function dbInfo()
	{
		return array(
		'class'=>'CDbConnection',
		'connectionString'=>'mysql:host=127.0.0.1;port=3306;dbname=yiisns',
		'username'=>'root',
		'password'=>'123456',
		'charset' => 'utf8',
		'enabled' => true,
		);
	}
}
