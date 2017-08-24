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
 * Contains managing data query functions
 * - add vehicle
 * - delete vehicle
 * - update vehicle
 * - select vehicle by id
 * - select all vehicle
 * - advanced search
 */
class CarDAO extends Utility
{

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $car = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $car[] = new Vehicle(
                $row["vehicleId"],
                $row["make"],
                $row["yearMade"],
                $row["model"],
                $row["price"],
                $row["mileage"],
                $row["transmission"],
                $row["drivetrain"],
                $row["engineCapacity"],
                $row["category"],
                $row["cylinder"],
                $row["doors"],
                $row["status"],
                $row["dateAdded"]
            );
        }
        $stmt = null;
        return $car;
    }

    // used for counting the number of records
    function countAll($sql) {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetchColumn(0)) {
            $results[] = $row[0];
        }
        return $results[0];
    }

    function getAllCars()
    {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $this->query($sql);
    }


    /**
     * create-method. This will create new row in database according to supplied
     * valueObject contents. Make sure that values for all NOT NULL columns are
     * correctly specified. Also, if this table does not use automatic surrogate-keys
     * the primary-key must be specified. After INSERT command this method will
     * read the generated primary-key back to valueObject if automatic surrogate-keys
     */
    function create(&$valueObject) {
        $sql =   '   INSERT  '  .
            '   INTO  '  .
            '     `vehicle`( `make`, `yearMade`, `model`, `price`, `mileage`,  '  .
            ' `transmission`, `drivetrain`,  `engineCapacity`,  `category`,  '  .
            ' `cylinder`, `doors`, `status`,  `dateAdded`  '  .
            '     )  '  .
            '   VALUES(  ';
        $sql = $sql."'".$valueObject->getMake()."', ";
        $sql = $sql."'".$valueObject->getYearMade()."', ";
        $sql = $sql."'".$valueObject->getModel()."', ";
        $sql = $sql."'".$valueObject->getPrice()."', ";
        $sql = $sql."".$valueObject->getMileage().", ";
        $sql = $sql."'".$valueObject->getTransmission()."', ";
        $sql = $sql."'".$valueObject->getDrivetrain()."', ";
        $sql = $sql."'".$valueObject->getEngineCapacity()."', ";
        $sql = $sql."'".$valueObject->getCategory()."', ";
        $sql = $sql."".$valueObject->getCylinder().", ";
        $sql = $sql."".$valueObject->getDoors().", ";
        $sql = $sql."'".$valueObject->getStatus()."', ";
        $sql = $sql."'".$valueObject->getDateAdded()."') ";
//        $db->execute($sql);




        return true;
    }

    function countAllCars() {
        $sql = "SELECT COUNT(*) FROM vehicle";
        return $this->countAll($sql);
    }





}