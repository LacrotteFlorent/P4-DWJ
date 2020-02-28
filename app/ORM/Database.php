<?php

namespace Framework\ORM;

use Framework\Http\Request;

class Database
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var array
     */
    private $manager = [];

    /**
     * @var Database
     */
    private static $databaseInstance;

    /**
     * @static
     * @param Request $request
     * @return Database
     */
    public static function getInstance(Request $request) : Database
    {
        if(!self::$databaseInstance) {
            self::$databaseInstance = new Database(
                $_ENV["DB_HOST"],
                $_ENV["DB_NAME"],
                $_ENV["DB_USER"],
                $_ENV["DB_PASS"]
            );
        }
        return self::$databaseInstance;
    }

    /**
     * Database constructor.
     * @param string $host
     * @param string $dbName
     * @param string $user
     * @param string $password
     */
    public function __construct($host, $dbName, $user, $password)
    {
        $this->pdo = new \PDO("mysql:dbname=". $dbName . ";host". $host, $user, $password);
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param string $model
     * @return Manager
     */
    public function getManager($model)
    {
        $managerClass = $model::getManager();
        $this->managers[$model] = $this->managers[$model] ?? new $managerClass($this->pdo, $model);
        return $this->managers[$model];
    }

}
