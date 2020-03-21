<?php

namespace Framework\ORM;

class Manager
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $model;

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
     * @param array $where
     * @param array $orderBy
     * @param bool $desc
     * @example requete: SELECT * FROM post LIMIT 3 OFFSET 4
     * @return Model
     */
    public function findAllWithLimitOffset($limit, $offset, $where = null)
    {   
        $from = array_values($this->metadata)[0];

        if($where){
            $paramSql = "";
            foreach ($params as $key => $param){
                $paramSql = $paramSql .''. $key .' = '.$param. ' AND ';
            }
            $paramSql = substr($paramSql, 0, -5);

            $sqlQuery = sprintf('SELECT * FROM %s WHERE %s LIMIT %s OFFSET %s', $from, $paramSql, $limit, $offset);
        }
        else{
            $sqlQuery = sprintf('SELECT * FROM %s LIMIT %s OFFSET %s', $from, $limit, $offset);
        }

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     * @param bool $desc
     * @param array $where
     * @example requete: SELECT * FROM post ORDER BY posted_at DESC LIMIT 3
     * @return array
     */
    public function findOrderByLimitOffset($limit, $offset, $orderBy, $desc = false, $where = null)
    {
        $from = array_values($this->metadata)[0];

        if($where){
            if($desc){
                $format = 'SELECT * FROM %s WHERE %s ORDER BY %s DESC LIMIT %s OFFSET %s';
            }
            else{
                $format = 'SELECT * FROM %s WHERE %s ORDER BY %s LIMIT %S OFFSET %s';
            }
            $sqlQuery = sprintf($format, $from, $where, $orderBy, $limit, $offset);
        }
        else{
            if($desc){
                $format = 'SELECT * FROM %s ORDER BY %s DESC LIMIT %s OFFSET %s';
            }
            else{
                $format = 'SELECT * FROM %s ORDER BY %s LIMIT %S OFFSET %s';
            }
            $sqlQuery = sprintf($format, $from, $orderBy, $limit, $offset);
        }

        return $this->fetchAll($sqlQuery);
    }

    /**
     * @param array $param
     * @example SELECT COUNT(*) FROM comment
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2 AND valid = 1 AND report = 0
     * @return int
     */
    public function countParam($params = null, $select = "*")
    {
        $from = array_values($this->metadata)[0];
        //$select = "*";

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
     * INSERT INTO comment(content, posted_at, valid, report, author, post_id)
     *  VALUES( 'ceci est une phrase de test', '2020-01-01 08:15:10', 1, 0, 'Guesttt', 1)
     */
    public function insertPrepare($table, $valuesByColumns)
    {
        // return columns
        $columns = array_keys($valuesByColumns);
        $strColumns = "";
        foreach($columns as $column){
            $strColumns = $strColumns .''.$column. ', ';
        }
        $strColumns = substr($strColumns, 0, -2);

        //return values
        $values = array_keys($valuesByColumns);
        $strValues = "";
        $arrayValues = [];
        foreach($columns as $column){
            $strValues = $strValues .':'.$column. ', ';
            $arrayValues[':'.$column] = $valuesByColumns[$column];
        }
        $strValues = substr($strValues, 0, -2);
        
        $sql = 'INSERT INTO ' . $table . '('. $strColumns .') VALUES('. $strValues .')';

        $statement = $this->pdo->prepare($sql);

        foreach($arrayValues as $key => $value){
            $statement->bindValue($key, $value);
        }

        $statement->execute();
    }

    /**
     * @param Model $model
     */
    public function insertByModel(Model $model)
    {
        $set = [];
        $values = [];
        $datas = [];
        foreach(array_keys($this->metadata["columns"]) as $column)
        {
            $sqlValue = $model->getSQLValueByColumn($column);
            $model->orignalData[$column] = $sqlValue;

            $datas[$column] = $sqlValue;
            $set[] = $column;
            $values[] = sprintf(":%s", $column);
        }

        $sqlQuery = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->metadata["table"], implode(", ", $set), implode(", ", $values));
        
        $this->pdo->prepare($sqlQuery)->execute($datas);
    }

    /**
     * @param Model $model
     * @param string $where
     */
    public function update(Model $model, $where = null)
    {

    }

    /**
     * @return array $metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

}