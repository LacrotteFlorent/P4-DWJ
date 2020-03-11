<?php

namespace Project\Manager;

use Framework\ORM\Manager;

class NewsletterManager extends Manager
{

    public function idLastInsert()
    {
        return $this->pdo->lastInsertId();
    }

}