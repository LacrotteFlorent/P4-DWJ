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
     * @param string $from
     * @return Model
     */
    public function find($id, $from)
    {
        $format = 'SELECT %s FROM %s WHERE %s%s;'; 
        $select = "*";
        $where = "id = ";

        $sqlQuery = sprintf($format, $select, $from, $where, $id);

        return $this->fetch($sqlQuery);
    }

    /**
     * @param string $nameParam
     * @param mixed $param
     * @param string $from
     * @return Model
     */
    public function findByParam($nameParam, $param, $from)
    {
        $format = 'SELECT %s FROM %s WHERE %s';
        $select = "*";
        $where = $nameParam . " = " . $param;

        $sqlQuery = sprintf($format, $select, $from, $where);

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param string $from
     * @param int $limit
     * @return Model
     */
    public function findAllWithLimit($from, $limit)
    {   
        $format = 'SELECT %s FROM %s LIMIT %s';

        $select = "*";

        $sqlQuery = sprintf($format, $select, $from, $limit);

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param string $sqlQuery
     * @return array
     */
    protected function fetch($sqlQuery)
    {
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        $result = (new $this->model())->hydrate($result);

        return $result;
    }

    /**
     * @param string $sqlQuery
     * @return array
     */
    protected function fetchAll($sqlQuery)
    {
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        dump($results);

        $data = [];
        foreach($results as $result){
            $data = (new $this->model())->hydrate($result);
        }

        return $data;
    }

    // créer une fcontion qui vérifie si le modèle ne comporte pas déja les mêmes données
    // par exemple si la requete envoyée a la BDD est identique et dans un délais de 2sec,
    // on ne relance pas la requete mais utilise la précédente

}


