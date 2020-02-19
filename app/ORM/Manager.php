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
    public function findAll($id, $from)
    {
        $format = 'SELECT %s FROM %s WHERE %s%s;'; 
        $select = "*";
        $where = "id = ";

        $sqlQuery = sprintf($format, $select, $from, $where, $id);

        $result = $this->statement($sqlQuery);
        return (new $this->model())->hydrate($result);
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
        
        $result = $this->statement($sqlQuery);
        return (new $this->model())->hydrate($result);
    }

    /**
     * @param string $sqlQuery
     * @return array
     */
    private function statement($sqlQuery)
    {
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    // créer une fcontion qui vérifie si le modèle ne comporte pas déja les mêmes données
    // par exemple si la requete envoyée a la BDD est identique et dans un délais de 2sec,
    // on ne relance pas la requete mais utilise la précédente

}


