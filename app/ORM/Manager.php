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
     * @param $model
     * @throws ORMException
     */
    public function __construct(\PDO $pdo, $model)
    {
        $this->pdo = $pdo;
        $reflectionClass = new \ReflectionClass($model);
        if($reflectionClass->getParentClass()->getName() == Model::class) {  //si le parent de classe passée en reflexion est un modele
            $this->model = $model;                              // Alors on recuère le modele
            $this->metadata = $this->model::metadata();         // et on recupère les métadata
        }
        else {
            throw new ORMException("Cette classe n'existe pas.");       // sinon cette classe n'existe pas
        }
        $this->model = $model;
    }
    /////////////////////////////


    public function find($id)
    {
        $format = 'SELECT %s FROM %s WHERE %s%d;'; 
        $select = "*";
        $from = "post";
        $where = "id = ";

        $sqlQuery = sprintf($format, $select, $from, $where, $id);
        dump($sqlQuery);

        $statement = $this->pdo->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        echo '<pre>';
        print_r($result);
        echo '</pre>';

    }


}


