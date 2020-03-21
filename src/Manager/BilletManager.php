<?php

namespace Project\Manager;

use Framework\ORM\Manager;

class BilletManager extends Manager
{

    /**
     * @param string $from
     * @param int $limit
     * @example requete: SELECT * FROM post ORDER BY posted_at DESC LIMIT 3
     * @return array
     */
    public function findByPostedAtWithLimit($limit = null)
    {
        $from = array_values($this->metadata)[0];

        $select = "*";

        if($limit){
            $format = 'SELECT %s FROM %s ORDER BY posted_at DESC LIMIT %s';
        }
        else{
            $format = 'SELECT %s FROM %s ORDER BY posted_at DESC';
        }

        $sqlQuery = sprintf($format, $select, $from, $limit);

        return $this->fetchAll($sqlQuery);
    }

}