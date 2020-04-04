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
            $paramSql = $this->where($params);
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
    public function findSelectByParam($selects = '*', $params = null)
    {
        $from = array_values($this->metadata)[0];

        if($selects != '*')
        {   
            $selectSql = $this->select($selects);
        }

        if($params){
            $selectSql = $this->where($params);
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
     * @param string $operator
     * @example requete: SELECT * FROM post LIMIT 3 OFFSET 4
     * @return Model
     */
    public function findAllWithLimitOffset($limit, $offset, $where = null, $operator = null)
    {   
        $from = array_values($this->metadata)[0];
        if($where){
            $paramSql = $this->where($where, $operator);

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
     * @param string $operator
     * @example requete: SELECT * FROM post ORDER BY posted_at DESC LIMIT 3
     * @return array
     */
    public function findOrderByLimitOffset($limit, $offset, $orderBy, $desc = false, $where = null, $operator = null)
    {
        $from = array_values($this->metadata)[0];
        if($where){
            $paramSql = $this->where($where, $operator);
            if($desc){
                $format = 'SELECT * FROM %s WHERE %s ORDER BY %s DESC LIMIT %s OFFSET %s';
            }
            else{
                $format = 'SELECT * FROM %s WHERE %s ORDER BY %s LIMIT %s OFFSET %s';
            }
            $sqlQuery = sprintf($format, $from, $paramSql, $orderBy, $limit, $offset);
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
     * @param string $select
     * @param string $operator
     * @example SELECT COUNT(*) FROM comment
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2
     * @example or SELECT COUNT(*) FROM comment WHERE post_id = 2 AND valid = 1 AND report = 0
     * @return array
     */
    public function countParam($params = null, $select = null , $operator = null)
    {
        $from = array_values($this->metadata)[0];
        if(!$select){
            $select = '*';
        }
        if($params){
            $paramSql = $this->where($params, $operator);
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
     * @return Model
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
     * @return int
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param Model $model
     */
    public function insertByModel(Model $model)
    {
        foreach(array_keys($this->metadata["columns"]) as $column)
        {
            $sqlValue = $model->getSQLValueByColumn($column);
            $model->originalData[$column] = $sqlValue;

            $datas[$column] = $sqlValue;
            $set[] = $column;
            $values[] = sprintf(":%s", $column);
        }

        $sqlQuery = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->metadata["table"], implode(", ", $set), implode(", ", $values));
        
        return $this->pdo->prepare($sqlQuery)->execute($datas);
    }

    /**
     * @param Model $model
     * @param array $where  @exemple ['id' => 1]
     */
    public function update(Model $model, $wheres)
    {
        foreach(array_keys($this->metadata["columns"]) as $column)
        {
            $sqlValue = $model->getSQLValueByColumn($column);
            $model->originalData[$column] = $sqlValue;
            $datas[$column] = $sqlValue;
        }
        
        $set = $this->where($datas, null, ',');
        $whereValues = $this->where($wheres);
        $sqlQuery = sprintf("UPDATE %s SET %s WHERE %s", $this->metadata["table"], $set, $whereValues);
        return $this->pdo->prepare($sqlQuery)->execute();
    }

    /**
     * @param Model $model
     * @param array $where  @exemple ['id' => 1]
     */
    public function delete($wheres)
    {
        $whereValues = $this->where($wheres);
        $sqlQuery = sprintf("DELETE FROM %s WHERE %s", $this->metadata["table"], $whereValues);
        return $this->pdo->prepare($sqlQuery)->execute();
    }

    /**
     * @return array $metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param array $wheres
     * @param string $operator
     * @param string $separator
     * @return string
     */
    private function where($wheres, $operator = null, $separator = null)
    {
        if(!$operator){
            $operator = '=';
        }
        if(!$separator){
            $separator = 'AND';
        }
        foreach($wheres as $key => $where){
            if(isset($where)){
                $whereValues[] = sprintf("%s %s '%s'", $key, $operator, $where);
            }
        }
        return implode(" $separator ", $whereValues);
    }

    /**
     * @param array $arrayValues
     * @return string
     */
    private function select($arrayValues)
    {
        $selectSql = "";
        foreach ($arrayValues as $select){
            $selectSql = $selectSql .''.$select. ', ';
        }
        $selectSql = substr($selectSql, 0, -2);
        return $selectSql;
    }

}