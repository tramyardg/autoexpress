<?php
require_once 'CarDAO.php';
require_once 'DiagramDAO.php';
/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-09-07
 * Time: 12:35 AM
 */
define("MAX_PRICE_MILEAGE", 999999);
define("MIN_PRICE_MILEAGE", 0);

class AdvanceSearch
{

    public function getSearchInputResult($submitBtnName) {
        $search = filter_input(INPUT_GET, $submitBtnName);

        if(!empty($search)) {
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
                "minYear" =>$minYear,
                "maxYear" => $maxYear,
                "minPrice" => $minPrice,
                "maxPrice" => $maxPrice,
                "minMileage" => $minMileage,
                "maxMileage" => $maxMileage
            );

            if(empty($searchArray["minPrice"])) {
                $searchArray["minPrice"] = MIN_PRICE_MILEAGE;
            }
            if(empty($searchArray["maxPrice"])) {
                $searchArray["maxPrice"] = MAX_PRICE_MILEAGE;
            }
            if(empty($searchArray["minMileage"])) {
                $searchArray["minMileage"] = MIN_PRICE_MILEAGE;
            }
            if(empty($searchArray["maxMileage"])) {
                $searchArray["maxMileage"] = MAX_PRICE_MILEAGE;
            }
            $v = new CarDAO();
            $searchCarResult = $v->getSearchResult($searchArray);

            $numResult =  count($searchCarResult);

            $this->setNumberOfResult($numResult);

            return $searchCarResult; // returns a car object
        } else {
            return null;
        }
    }

    private $numberOfResult;

    /**
     * @return mixed
     */
    public function getNumberOfResult()
    {
        return $this->numberOfResult;
    }

    /**
     * @param mixed $numberOfResult
     */
    public function setNumberOfResult($numberOfResult)
    {
        $this->numberOfResult = $numberOfResult;
    }

    public function resultFoundMessage() {
        if($this->getNumberOfResult() === 0) {
            return '<p style="padding: 0;">no vehicle found.</p>';
        } else if($this->getNumberOfResult() === 1) {
            return '<p style="padding: 0;">1 vehicle found.</p>';
        } else {
            return '<p style="padding: 0;">'. $this->getNumberOfResult() . ' vehicles found.</p>';
        }
    }


}