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
    private $metadata;

    /**
     * Manager constructor.
     * @param \PDO $pdo
     * @param $model
     * @throws ORMException
     */
    public function __construct(\PDO $pdo, $model)
    {
        $this->pdo = $pdo;
        $reflectionClass = new \ReflexionClass($model);
        if($reflexionClass->getParentClass()->getName() == Model::class) {
            $this->model = $model;
            $this->metadata = $this->model::metadata();
        }
        else {
            throw new ORMException("Cette classe n'existe pas.");
        }
        $this->model = $model;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function getColumnByProperty($property)
    {
        $property = lcfirst($property);
        $colums = array_keys(array_filter($this->metadata["columns"], function($column) use ($property) {
            return $column["property"] == $property;
        }));
        $column = array_shift($columns);
        return $column;
    }

    /**
     * @param array $filters
     * @return string
     */
    private function where($filters = [])
    {
        if(!empty($filters)) {
            $condition = [];
            foreach($filters as $property => $value) {
                $condition[] = sprintf("%s = :%s", $this->getColumnByProperty($property), $property);
            }
            return sprintf("WHERE %s", implode($conditions, "AND "));
        }
        return "";
    }

    /**
     * @param array $sorting
     * @return string
     */
    private function orderBy($sorting = [])
    {
        if(!empty($sorting)) {
            $sorts = [];
            foreach($sorting as $property => $value) {
                $sorts[] = sprintf("%s %s", $this->getColumnByProperty($property), $value);
            }
            return sprintf("ORDER BY %s", implode($sorts, ","));
        }
        return "";
    }

    /**
     * @param array $filters
     * @return Model
     */
    public function fetch($filters = [])
    {
        $sqlQuery = sprintf("SELECT * FROM %s %s LIMIT 0,1", $this->metadata["table"], $this->where($filters));
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute($filters);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return (new $this->model())->hydrate($result);
    }

    /**
     * @param mixed $id
     * @return Model
     */
    public function find($id)
    {
        return $this->fetch([$this->metadata["primaryKey"] => $id]);
    }

    public function persist(Model $model)
    {
        if($model->getPrimaryKey()) {
            $this->update($model);
        }else{
            $this->insert($model);
        }
    }

    /**
     * @param Model $model
     */
    private function update(Model &$model)
    {
        $set = [];
        $parameters = [];
        foreach(array_keys($this->metadata["columns"]) as $column)
        {
            $sqlValue = $model->getSQLValueByColumn($column);
            if($sqlValue !== $model->originalData[$column]) {
                $parameters[$column] = $sqlValue;
                $model->orignalData[$column] = $sqlValue;
                $set[] = sprintf("%s = :%s", $column, $column);
            }
        }
        if(count($set)) {
            $sqlQuery = sprintf("UPDATE %s SET %s WHERE %s = :id", $this->metadata["table"], implode(",", $set), $this->metadata["primaryKey"]);
            $statement = $this->pdo->prepare($sqlQuery);
            $statement->execute(["id" => $model->getPrimaryKey()]);
        }
    }

    /**
     * @param Model $model
     */
    private function insert(Model &$model)
    {
        $set = [];
        $parameters = [];
        foreach(array_keys($this->metadata["columns"]) as $column)
        {
            $sqlValue = $model->getSQLValueByColumn($column);
            $model->orignalData[$column] = $sqlValue;
            $parameters[$column] = $sqlValue;
            $set[] = sprintf("%s = :%s", $column, $column);
        }
        $sqlQuery = sprintf("INSERT INTO %s SET %s", $this->metadata["table"], implode(",", $set));
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute($parameters);
        $model->setPrimaryKey($this->pdo->lastInsertId());
    }

    /**
     * @param Model $model
     */
    public function remove(Model $model)
    {
        $sqlQuery = sprintf("DELETE FROM %s WHERE %s = :id", $this->metadata["table"], $this->metadata["primaryKey"]);
        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute(["id" => $model->getPrimaryKey()]);
    }

}


