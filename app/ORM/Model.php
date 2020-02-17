<?php

namespace Framework\ORM;


abstract class Model
{
    /**
     * @var array
     */
    public $originalData = [];

    /**
     * @return array
     */
    public abstract static function metadata();

    /**
     * @return string
     */
    public abstract static function getManager();

    /**
     * @param array $result
     * @return Model
     * @throws ORMException
     */
    public function hydrate($result)
    {
        if(empty($result)){
            throw new ORMException("Aucun résultat !");
        }
        $this->originalData = $result;

        foreach($result as $column => $value){
            $dataString = sprintf("set%s", ucfirst($this::metadata()["columns"][$column]["property"]));

            switch ($this::metadata()["columns"][$column]["type"]) {
                case 'string':
                    $this->{sprintf($dataString)} ($value);
                    break;
                
                case 'integer':
                    $this->{sprintf($dataString)} ((int) $value);
                    break;
                
                case 'bool':
                    $this->{sprintf($dataString)} ((bool) $value);
                    break;

                case 'datetime':
                    $datetime = \DateTime::createFromFormat("Y-m-d H:i:s", $value);
                    $this->{sprintf($dataString)} ($datetime);
                    break;
                
                default:
                    throw new ORMException ("Ce type de variable n'est pas pris en compte");
                    break;
            }
        }
        return $this;
    }
    
}

////////////////////////////////////


//    /**
//     * @param string $column
//     * @return mixed
//     */
//    public function getSQLValueByColumn($column)
//    {
//        $value = $this->{sprintf("get%s", ucfirst($this::metadata()["columns"][$column]["property"]))}();
//        if($value instanceof \DateTime){
//            return $value->format("Y-m-d H:i:s");
//        }
//        return $value;
//    }
//
//    /**
//     * @param mixed $value
//     */
//    public function setPrimaryKey($value)
//    {
//        $this->hydrateProperty($this::metadata()["primaryKey"], $value);
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getPrimaryKey()
//    {
//        $primaryKeyColumn = $this::metadata()["primaryKey"];
//        $property = $this::metadata()["columns"][$primaryKeyColumn]["property"];
//        return $this->{sprintf("get%s", ucfirst($property))}();
//    }