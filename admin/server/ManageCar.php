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
class ManageCar
{

    function selectAllVehicle()
    {
        $db = new DbQueryResult();
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $db->query($sql);
    }

    // map sql result to Admin class
    function allVehicleData()
    {
        $results = ManageCar::selectAllVehicle();
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



}