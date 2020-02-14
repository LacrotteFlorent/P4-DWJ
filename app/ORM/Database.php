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
            self::$databaseInstance = new Database("localhost","blog","jeanftr","BDDJFTR");
            //self::$databaseInstance = new Database(
            //    $request->getEnv("DB_HOST"),
            //    $request->getEnv("DB_NAME"),
            //    $request->getEnv("DB_USER"),
            //    $request->getEnv("DB_PASSWORD")
            //);
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
    public function getManager($model) : Manager
    {
        dump($model);
        $managerClass = $model::getManager();
        $this->managers[$model] = $this->managers[$model] ?? new $mangerClass($this->pdo, $model);
        return $this->managers[$model];
    }

}
