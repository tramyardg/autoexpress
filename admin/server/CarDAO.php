<?php

require_once 'class/Utility.php';
require_once '../Db.php';
require_once 'class/Vehicle.php';
/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-06
 * Time: 8:05 PM
 *
 * Contains managing car query functions
 * - add vehicle
 * - delete vehicle
 * - update vehicle
 * - select vehicle by id
 * - select all vehicle
 * - advanced search
 */
class CarDAO extends Utility
{

    function getAllCars()
    {
        $db = new DbQueryResult();
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $db->query($sql);
    }

    function allCarsData()
    {
        $results = CarDAO::getAllCars();
        $car_obj = array();
        if (!$results) {
            return $results;
        } else {
            foreach ($results as $result) {
                $car_obj[] = new Vehicle($result);
            }
        }
        return $car_obj;
    }

    function countAllCars() {
        $db = new DbQueryResult();
        $sql = "SELECT COUNT(*) FROM vehicle";
        return $db->countAll($sql);
    }



}