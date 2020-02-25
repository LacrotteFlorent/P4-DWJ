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
     * @example requete: SELECT * FROM post WHERE id = 2
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
     * @param array $params
     * @param string $from
     * @example requete: SELECT * FROM post WHERE post_id = 3
     * @return Model
     */
    public function findAllByParam($params = null, $from)
    {
        $select = "*";
        if($params){
            $paramSql = "";
            foreach ($params as $key => $param){
                $paramSql = $paramSql .''. $key .' = '.$param. ' AND ';
            }
            $paramSql = substr($paramSql, 0, -5);

            $format = 'SELECT %s FROM %s WHERE %s';
            $sqlQuery = sprintf($format, $select, $from, $paramSql);
        }
        else{
            $format = 'SELECT %s FROM %s';
            $sqlQuery = sprintf($format, $select, $from);
        }

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param array $select
     * @param array $params
     * @param string $from
     * @example requete: SELECT like_count FROM comment WHERE post_id = 3
     * @return Model
     */
    public function findSelectByParam($from, $selects = null, $params = null)
    {
        if($selects)
        {   
            $selectSql = "";
            foreach ($selects as $select){
                $selectSql = $selectSql .''.$select. ', ';
            }
            $selectSql = substr($selectSql, 0, -2);
        }
        else{
            $selectSql = "*";
        }

        if($params){
            $paramSql = "";
            foreach ($params as $key => $param){
                $paramSql = $paramSql .''. $key .' = '.$param. ' AND ';
            }
            $paramSql = substr($paramSql, 0, -5);

            $format = 'SELECT %s FROM %s WHERE %s';
            $sqlQuery = sprintf($format, $selectSql, $from, $paramSql);
        }
        else{
            $format = 'SELECT %s FROM %s';
            $sqlQuery = sprintf($format, $selectSql, $from);
        }
        dump($sqlQuery);
        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param string $from
     * @param int $limit
     * @example requete: SELECT * FROM post LIMIT 3
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
     * @param string $from
     * @param int $limit
     * @param int $offset
     * @example requete: SELECT * FROM post LIMIT 3 OFFSET 4
     * @return Model
     */
    public function findAllWithLimitOffset($from, $limit, $offset)
    {   
        $format = 'SELECT %s FROM %s LIMIT %s OFFSET %s';

        $select = "*";

        $sqlQuery = sprintf($format, $select, $from, $limit, $offset);

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param string $from
     * @param array $param
     * @example SELECT COUNT(*) FROM comment
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2 AND valid = 1 AND report = 0
     * @return int
     */
    public function countParam($from, $params = null)
    {
        $select = "*";

        if($params){
            $paramSql = "";
            foreach($params as $key => $param){
                $paramSql = $paramSql .''. $key .' = '.$param. ' AND ';
            }
            $paramSql = substr($paramSql, 0, -5);
            $format = 'SELECT COUNT(%s) as count FROM %s WHERE %s';
            $sqlQuery = sprintf($format, $select, $from, $paramSql);
        }
        else{
            $format = 'SELECT COUNT(%s) as count FROM %s';
            $sqlQuery = sprintf($format, $select, $from);
        }

        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
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

        $data = [];
        foreach($results as $result){
            array_push($data, (new $this->model())->hydrate($result));
        }
        return $data;
    }

    // créer une fcontion qui vérifie si le modèle ne comporte pas déja les mêmes données
    // par exemple si la requete envoyée a la BDD est identique et dans un délais de 2sec,
    // on ne relance pas la requete mais utilise la précédente

}


