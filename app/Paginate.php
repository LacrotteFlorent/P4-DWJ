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
     * @var int $actualPage
     */
    private $actualPage;

    /**
     * @var array $pageAroundActualPage
     */
    private $pageAroundActualPage;

    /**
     * @var array $showElements
     */
    private $showElements;

    /**
     * Paginate constructor
     * @param int $nbItemTotal
     * @param int $nbItemByPage
     * @param int $actualPage
     */
    public function __construct($nbItemByPage, $nbItemTotal, $actualPage)
    {
        $this->nbItemByPage = $nbItemByPage;
        $this->nbItemTotal = $nbItemTotal;
        $this->actualPage = $actualPage;
        $this->calcPaginate();
        $this->calcShowElements();
    }

    /**
     * @internal Calc $pageAroundActualPage
     */
    private function calcPaginate()
    {
        $this->nbPages = (int) ceil($this->nbItemTotal / $this->nbItemByPage);

        if($this->actualPage >= 3){
            $pageMin = $this->actualPage-2;
        }
        else{
            $pageMin = 1;
        }

        if($this->nbPages > ($this->actualPage+2)){
            $pageMax = $this->actualPage+2;
        }
        else{
            $pageMax = $this->actualPage;
        }
        
        $this->pageAroundActualPage = range($pageMin, $pageMax);

    }

    /**
     * @internal Calc $showElements
     */
    private function calcShowElements()
    {
        $showElementsMin = $this->actualPage*5;
        $showElementsMax = ($this->actualPage*5)+4;

        $this->showElements = range($showElementsMin, $showElementsMax);
    }

    /**
     * @return int
     */
    public function getLastPage() : int
    {
        return $this->nbPages;
    }

    /**
     * @return int
     */
    public function getActualPage() : int
    {
        return $this->actualPage;
    }

    /**
     * @return array
     */
    public function getPages() : array
    {
        return $this->pageAroundActualPage;
    }

    /**
     * @return array
     */
    public function getShowElements() : array
    {
        return $this->showElements;
    }

}