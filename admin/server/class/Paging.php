<?php
/*
$page = null;
if(isset($_GET['page'])) {
$page = $_GET['page'];
} else {
$page = 0;
}
$startingPoint = $page;
$recordsPerPage = RECORDS_PER_PAGE;
$prev = $startingPoint - $recordsPerPage;
$next = $startingPoint + $recordsPerPage;
 */
define('START_ROW', 0);
class Paging
{
    public $_prev;
    public $_next;
    public $_startingRow;
    public $_recordsPerPage;
    public $_pageQueryStr;

    /**
     * @return mixed
     */
    public function getPrev()
    {
        $startingPoint = $this->getStartingRow();
        $recordsPerPage = $this->getRecordsPerPage();
        return $this->_prev = $startingPoint - $recordsPerPage;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        $startingPoint = $this->getStartingRow();
        $recordsPerPage = $this->getRecordsPerPage();
        return $this->_next = $startingPoint + $recordsPerPage;
    }

    /**
     * @return mixed
     */
    public function getStartingRow()
    {
        return $this->_startingRow;
    }

    /**
     * @param mixed $_startingRow
     */
    public function setStartingRow($_startingRow)
    {
//        $this->startingRow = $this->getPageRow();
        $this->_startingRow = $_startingRow;
    }

    /**
     * @return mixed
     */
    public function getRecordsPerPage()
    {
        return $this->_recordsPerPage;
    }

    /**
     * @param mixed $_recordsPerPage
     */
    public function setRecordsPerPage($_recordsPerPage)
    {
        $this->_recordsPerPage = $_recordsPerPage;
    }

    /**
     * @return mixed
     */
    public function getPageQueryStr()
    {
        return $this->_pageQueryStr;
    }

    /**
     * @param mixed $_pageQueryStr
     */
    public function setPageQueryStr($_pageQueryStr)
    {
        $this->_pageQueryStr = $_pageQueryStr;
    }

    /**
     * Usage (in square brackets):
     * [Page query string = can be anything]
     * index.php?[page]=
     */
    public function getPageRowNumber() {
        if(isset($_GET[$this->getPageQueryStr()])) {
            return $_GET[$this->getPageQueryStr()];
        } else {
            return START_ROW;
        }
    }


}