<?php
require_once 'model/Dbh.php';
require_once 'CarDAO.php';
require_once 'DiagramDAO.php';

/**
 * @author: @tramyardg
 */

define("MAX_PRICE_MILEAGE", 999999);
define("MIN_PRICE_MILEAGE", 0);

class AdvanceSearchDAO extends CarDAO
{

    public $searchResultLength;

    public function getSearchResultLength()
    {
        return $this->searchResultLength;
    }

    public function setSearchResultLength($searchResultLength)
    {
        $this->searchResultLength = $searchResultLength;
    }

    /**
     * Does not return car object, use
     * row['colName'] to get content
     * @param $searchArray
     * @return PDOStatement
     */
    function getSearchResult($searchArray)
    {
        $sql = "SELECT\n"
            . " `vehicleId`,\n"
            . " `make`,\n"
            . " `yearMade`,\n"
            . " `model`,\n"
            . " `price`,\n"
            . " `mileage`,\n"
            . " `transmission`,\n"
            . " `drivetrain`,\n"
            . " `engineCapacity`,\n"
            . " `category`,\n"
            . " `cylinder`,\n"
            . " `doors`,\n"
            . " `status`,\n"
            . " `dateAdded`,\n"
            . " CONCAT(`yearMade`,\n"
            . " ' ',\n"
            . " `make`,\n"
            . " ' ',\n"
            . " `model`) AS `vehicleTitle`\n"
            . "FROM\n"
            . " `vehicle`\n"
            . "WHERE\n"
            . " make LIKE '%" . $searchArray['searchMake'] . "%' \n"
            . " AND model LIKE '" . $searchArray['searchModel'] . "' \n"
            . " AND yearMade BETWEEN " . $searchArray['minYear'] . " AND " . $searchArray['maxYear'] . " \n"
            . " AND (REPLACE(mileage, ',', '')) BETWEEN " . $searchArray['minMileage'] . " and " . $searchArray['maxMileage'];
        // echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $this->setSearchResultLength($stmt->rowCount());

        return $stmt;
    }


    /**
     * This function is important
     * because it sets
     * @param $submitBtnName
     * @return null|PDOStatement
     */
    function getSearchInputResult($submitBtnName)
    {
        $search = filter_input(INPUT_GET, $submitBtnName);

        if (!empty($search)) {
            $searchMake = filter_input(INPUT_GET, 'searchMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $searchModel = filter_input(INPUT_GET, 'searchModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $minYear = filter_input(INPUT_GET, 'minYear', FILTER_VALIDATE_INT);
            $maxYear = filter_input(INPUT_GET, 'maxYear', FILTER_VALIDATE_INT);
            $minPrice = filter_input(INPUT_GET, 'minPrice', FILTER_VALIDATE_INT);
            $maxPrice = filter_input(INPUT_GET, 'maxPrice', FILTER_VALIDATE_INT);
            $minMileage = filter_input(INPUT_GET, 'minMileage', FILTER_VALIDATE_INT);
            $maxMileage = filter_input(INPUT_GET, 'maxMileage', FILTER_VALIDATE_INT);

            $searchArray = array(
                "searchMake" => $searchMake,
                "searchModel" => $searchModel,
                "minYear" => $minYear,
                "maxYear" => $maxYear,
                "minPrice" => $minPrice,
                "maxPrice" => $maxPrice,
                "minMileage" => $minMileage,
                "maxMileage" => $maxMileage
            );

            if (empty($searchArray["minPrice"])) {
                $searchArray["minPrice"] = MIN_PRICE_MILEAGE;
            }
            if (empty($searchArray["maxPrice"])) {
                $searchArray["maxPrice"] = MAX_PRICE_MILEAGE;
            }
            if (empty($searchArray["minMileage"])) {
                $searchArray["minMileage"] = MIN_PRICE_MILEAGE;
            }
            if (empty($searchArray["maxMileage"])) {
                $searchArray["maxMileage"] = MAX_PRICE_MILEAGE;
            }

            $searchCarResult = $this->getSearchResult($searchArray);

            return $searchCarResult; // returns a car object
        } else {
            return null;
        }
    }

    public function getResultFoundMessage()
    {
        if ($this->getSearchResultLength() === 0) {
            return '<p style="padding: 0;">no vehicle found.</p>';
        } else if ($this->getSearchResultLength() === 1) {
            return '<p style="padding: 0;">1 vehicle found.</p>';
        } else {
            return '<p style="padding: 0;">' . $this->getSearchResultLength() . ' vehicles found.</p>';
        }
    }
}