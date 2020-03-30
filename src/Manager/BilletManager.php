<?php

namespace Project\Manager;

use Framework\ORM\Manager;

class BilletManager extends Manager
{

    /**
     * @param string $from
     * @param int $limit
     * @param array $params
     * @param string $operator
     * @example requete: SELECT * FROM post ORDER BY posted_at DESC LIMIT 3
     * @return array
     */
    public function findByPostedAtWithLimit($limit = null, $params = null, $operator = null)
    {
        $from = array_values($this->metadata)[0];

        $select = "*";

        if(!$operator){
            $operator = '=';
        }

        if($params){
            $paramSql = "";
            foreach ($params as $key => $param){
                $paramSql = $paramSql .''. $key .' ' . $operator .' \''.$param. '\' AND ';
            }
            $paramSql = substr($paramSql, 0, -5);

            if($limit){
                $format = 'SELECT %s FROM %s WHERE %s ORDER BY posted_at DESC LIMIT %s';
                $sqlQuery = sprintf($format, $select, $from, $paramSql, $limit);
            }
            else{
                $format = 'SELECT %s FROM %s WHERE %s ORDER BY posted_at DESC';
                $sqlQuery = sprintf($format, $select, $from, $paramSql);
            }
        }
        else{
            if($limit){
                $format = 'SELECT %s FROM %s ORDER BY posted_at DESC LIMIT %s';
            }
            else{
                $format = 'SELECT %s FROM %s ORDER BY posted_at DESC';
            }
            $sqlQuery = sprintf($format, $select, $from, $limit);
        }
        return $this->fetchAll($sqlQuery);
    }

}