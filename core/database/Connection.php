<?php

namespace antonio\core\database;

use antonio\app\exceptions\AppException;
use PDOException;
use PDO;
use antonio\core\App;

class Connection
{
	/**
	 * @return PDO
	 * @throws AppException
	 */
	public static function make()
	{
		try {
			$config = App::get('config')['database'];
			$connection = new PDO(
				$config['connection'] . ';dbname=' . $config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);
		} catch (PDOException $PDOException) {
			throw new AppException('No se ha podido crear la conexión a la base de datos');
		}
		return $connection;
	}
}
