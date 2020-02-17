<?php

namespace Framework\ORM;

use Project\Model\BilletModel;

class Manager
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $model;

    /**
     * @var array
     */
    private $metadata;

    /**
     * Manager constructor.
     * @param \PDO $pdo
     * @param string $model
     * @throws ORMException
     * @note [Si le parent de la classe qui correspond au modèle existe
     * @note  alors on récupère le modèle et les métadata]
     */
    public function __construct(\PDO $pdo, $model)
    {
        $this->pdo = $pdo;
        $reflectionClass = new \ReflectionClass($model);
        if($reflectionClass->getParentClass()->getName() == Model::class){
            $this->model = $model;
            $this->metadata = $this->model::metadata();
        }
        else {
            throw new ORMException("Cette classe n'existe pas.");
        }
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        $format = 'SELECT %s FROM %s WHERE %s%d;'; 
        $select = "*";
        $from = "post";
        $where = "id = ";

        $sqlQuery = sprintf($format, $select, $from, $where, $id);

        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return (new $this->model())->hydrate($result);
    }


}


