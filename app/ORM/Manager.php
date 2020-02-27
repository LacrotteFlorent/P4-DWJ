<?php

namespace Framework\ORM;

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
    protected $metadata;

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
     * @example requete: SELECT * FROM post WHERE id = 2
     * @return Model
     */
    public function find($id)
    {
        $from = array_values($this->metadata)[0];

        $format = 'SELECT %s FROM %s WHERE %s%s;'; 
        $select = "*";
        $where = "id = ";

        $sqlQuery = sprintf($format, $select, $from, $where, $id);

        return $this->fetch($sqlQuery);
    }

    /**
     * @param array $params
     * @example requete: SELECT * FROM post WHERE post_id = 3
     * @return Model
     */
    public function findAllByParam($params = null)
    {
        $from = array_values($this->metadata)[0];
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
     * @example requete: SELECT like_count FROM comment WHERE post_id = 3
     * @return Model
     */
    public function findSelectByParam($selects = null, $params = null)
    {
        $from = array_values($this->metadata)[0];

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
     * @param int $limit
     * @example requete: SELECT * FROM post LIMIT 3
     * @return Model
     */
    public function findAllWithLimit($limit)
    {   
        $from = array_values($this->metadata)[0];

        $format = 'SELECT %s FROM %s LIMIT %s';

        $select = "*";

        $sqlQuery = sprintf($format, $select, $from, $limit);

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @example requete: SELECT * FROM post LIMIT 3 OFFSET 4
     * @return Model
     */
    public function findAllWithLimitOffset($limit, $offset)
    {   
        $from = array_values($this->metadata)[0];

        $format = 'SELECT %s FROM %s LIMIT %s OFFSET %s';

        $select = "*";

        $sqlQuery = sprintf($format, $select, $from, $limit, $offset);

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param array $param
     * @example SELECT COUNT(*) FROM comment
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2 AND valid = 1 AND report = 0
     * @return int
     */
    public function countParam($params = null)
    {
        $from = array_values($this->metadata)[0];
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

    /**
     * @param $string $table
     * @param array $valuesByColumns
     * @internal { for @param $valuesByColumns ['column' => $value]}
     */
    public function insert($table, $valuesByColumns)
    {
        $columns = array_values($valuesByColumns);
        $values = array_keys($valuesByColumns);

        $strColumns = "";
        foreach($columns as $column){
            $strColumns = $strColumns .''.$column. ', ';
        }
        $strColumns = substr($strColumns, 0, -2);

        dump($strColumns);

        $strValues = "";
        foreach($values as $value){
            $strValues = $strValues .':'.$value. ', ';
        }
        $strValues = substr($strValues, 0, -2);

        dump($strValues);

        $sqlQuery = 'INSERT INTO ' . $table . '(' . $strColumns . ') VALUES(' . $strValues .')';

        dump($sqlQuery);

        $statement = $this->pdo->prepare($sqlQuery);

        dump($valuesByColumns);

        $statement->execute($valuesByColumns);
    }
    // set model ?

    /**
     * @todo implémentation fonction for backOffice
     */
    public function update()
    {

    }

}