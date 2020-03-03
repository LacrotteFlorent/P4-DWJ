<?php

namespace Framework;

class Paginate
{

    /**
     * @var int $nbItemByPage
     */
    private $nbItemByPage;

    /**
     * @var int $nbItemTotal
     */
    private $nbItemTotal;

    /**
     * @var int $nbPages
     */
    private $nbPages;

    /**
     * Paginate constructor
     * @param int $nbItemTotal
     * @param int $nbItemByPage
     */
    public function __construct($nbItemByPage, $nbItemTotal)
    {
        $this->nbItemByPage = $nbItemByPage;
        $this->nbItemTotal = $nbItemTotal;
    }

    public function nbPages()
    {

    }

}