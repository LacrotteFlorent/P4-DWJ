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

            if($this::metadata()["columns"][$column]["type"]){
                switch ($this::metadata()["columns"][$column]["type"]) {
                    case 'string':
                        $this->{sprintf($dataString)} ($value);
                        break;
                    
                    case 'integer':
                        $this->{sprintf($dataString)} ((int) $value);
                        break;
                    
                    case 'integerOrNull':
                        if(empty($value)){
                            $this->{sprintf($dataString)} (null);
                        }
                        else{
                            $this->{sprintf($dataString)} ((int) $value);
                        }
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
        }
        return $this;
    }

    /**
     * @param array $values
     * @return Model
     * @throws ORMException
     */
    public function hydrateForSql($datas)
    {
        if(empty($datas)){
            throw new ORMException("Aucun résultat !");
        }
        $this->originalData = $datas;

        foreach($datas as $column => $value){
            $dataString = sprintf("set%s", ucfirst($this::metadata()["columns"][$column]["property"]));
            
            if($this::metadata()["columns"][$column]["type"]){
                switch ($this::metadata()["columns"][$column]["type"]) {
                    case 'string':
                        $this->{sprintf($dataString)} ($value);
                        break;
                    
                    case 'integer':
                        $this->{sprintf($dataString)} ((int) $value);
                        break;
                    
                    case 'integerOrNull':
                        if(empty($value)){
                            $this->{sprintf($dataString)} (null);
                        }
                        else{
                            $this->{sprintf($dataString)} ((int) $value);
                        }
                        break; 
                    
                    case 'bool':
                        $this->{sprintf($dataString)} ((int) $value);
                        break;

                    case 'datetime':
                        if($value instanceof \DateTime){
                            $this->{sprintf($dataString)} ((string) $value->format("Y-m-d H:i:s"));
                        }
                        else{
                            $this->{sprintf($dataString)} ((string) $value);
                        }
                        break;
                    
                    default:
                        throw new ORMException ("Ce type de variable n'est pas pris en compte");
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function getSQLValueByColumn($column)
    {
        $value = $this->{sprintf("get%s", ucfirst($this::metadata()["columns"][$column]["property"]))}();
        if($value instanceof \DateTime){
            return $value->format("Y-m-d H:i:s");
        }
        return $value;
    }

}