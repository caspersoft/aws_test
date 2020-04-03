<?php
namespace App;

use PDO;

class Model {

    protected $db;

    public function __construct()
    {
        try {
			$this->db = new PDO(
				'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
				DB_USER,
				DB_PASS,
				[
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				]
			);
		} catch (\PDOException $e) {
			die('Подключение не удалось: ' . $e->getMessage());
		}
    }
}
