<?php

namespace Project\Manager;

use Framework\ORM\Manager;

class ImageManager extends Manager
{

    public function idLastInsert()
    {
        return $this->pdo->lastInsertId();
    }

}