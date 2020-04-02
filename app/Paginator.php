<?php

namespace Framework;

use Framework\Http\Request;

class Paginator
{
    /**
     * @var Request $request
     */
    private $request;

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
     * @var array $itemsToShow
     */
    private $itemsToShow;

    /**
     * @var Manager $managerItems
     */
    private $managerItems;

    /**
     * @var bool $paginate
     */
    private $paginate;

    /**
     * Paginate constructor
     * @param Request $request
     * @param int $nbItemTotal
     * @param Manager $managerItems
     * @param CONST $CONST_NB_PAGE
     * @param CONST $CONST_QUERY name of param page in GET
     * @param string|null $paramSql
     * @param string|null $orderBy
     * @param bool|null $desc
     * @param string|null $operator
     */
    public function __construct($request, $nbItemTotal, $managerItems, $CONST_NB_PAGE, $CONST_QUERY, $paramSql = null, $orderBy = null, $desc = false, $operator = null)
    {
        $this->request = $request;
        $this->nbItemByPage = (int) $_ENV[$CONST_NB_PAGE];
        $this->nbItemTotal = $nbItemTotal;
        $this->managerItems = $managerItems;
        $this->paging($CONST_QUERY, $paramSql, $orderBy, $desc, $operator);
    }

    /**
     * @internal
     *  WARNING Use $desc Only if $orderBy is not null
     * 
     * @uses $this->calcPaginate()
     * @uses $thi->calcShowElements()
     * 
     * @param CONST $CONST_QUERY
     * @param string|null $paramSql
     * @param string|null $orderBy
     * @param bool|null $desc
     * @param string|null $operator
     * 
     * @internal 
     *  Paging only retrieves the MySql data that will be
     *  displayed according to the current page.
     */
    private function paging($CONST_QUERY, $paramSql = null, $orderBy = null, $desc = false, $operator = null)
    {
        if(isset($this->request->getQuery()[$CONST_QUERY])){
            $this->actualPage = $_GET[$CONST_QUERY];
        }
        else{
            $this->actualPage = 1;
        }

        $this->calcPaginate();
        $this->calcShowElements();

        if($this->nbItemTotal > $this->nbItemByPage){
            $this->paginate = true;
            if($orderBy){
                $this->itemsToShow = $this->managerItems->findOrderByLimitOffset($this->nbItemByPage, $this->showElements[0], $orderBy, $desc, $paramSql, $operator);
            }
            else{
                $this->itemsToShow = $this->managerItems->findAllWithLimitOffset($this->nbItemByPage, $this->showElements[0], $paramSql, $operator);
            }
        }
        else{
            $this->paginate = false;
            $this->itemsToShow = $this->managerItems->findAllByParam($paramSql);
        }
    }

    /**
     * @used-by $this->paging()
     * 
     * @throws \Exception  if $actualPage doesn't exist
     * 
     * @internal
     *  Calculates the number of pages based on the database,
     *  and returns a table of numbers that corresponds to the
     *  pages surrounding the current page. +2 and -2.
     */
    private function calcPaginate()
    {
        $this->nbPages = (int) ceil($this->nbItemTotal / $this->nbItemByPage);

        if(($this->actualPage > $this->nbPages && $this->actualPage > 1) || ($this->paginate === false && $this->actualPage > 1)){
            throw new \Exception("Hop, hop, hop, ou allez vous ? Cette page n'existe pas !");
        }

        if($this->actualPage >= 3){
            $pageMin = $this->actualPage-2;
        }
        else{
            $pageMin = 1;
        }

        if($this->nbPages > ($this->actualPage+1)){
            $pageMax = $this->actualPage+2;
        }
        elseif($this->nbPages == $this->actualPage){
            $pageMax = $this->actualPage;
        }
        else{
            $pageMax = $this->actualPage+1;
        }

        $this->pageAroundActualPage = range($pageMin, $pageMax);
    }

    /**
     * @used-by $this->paging()
     * 
     * @internal 
     * Retourne un tableau avec le numéro des éléments
     * de la base de donnée à afficher en fonction de la page actuelle.
     */
    private function calcShowElements()
    {
        if($this->actualPage == 1){
            $showElementsMin = 0;
        }
        else{
            $showElementsMin = ($this->actualPage*$this->nbItemByPage)-$this->nbItemByPage;
        }
        
        if($this->actualPage == 1){
            $showElementsMax = $this->nbItemByPage-1;
        }
        else{
            $showElementsMax = ($this->actualPage*$this->nbItemByPage)-1;
        }

        if($this->nbItemTotal <= $showElementsMax){
            $showElementsMax = ($this->nbItemTotal) -1;
        }
        
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
    public function getItemsToShow() : array
    {
        return $this->itemsToShow;
    }

    /**
     * @return bool
     */
    public function getPaginate() : bool
    {
        return $this->paginate;
    }

    /**
     * @return array
     */
    public function getShowElements() : array
    {
        return $this->showElements;
    }

}