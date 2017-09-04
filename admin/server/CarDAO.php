<?php

require_once 'class/Utility.php';
require_once 'class/Dbh.php';
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
 *
 * Remember list
 * - ALWAYS RETURN $stmt
 */
class CarDAO extends Utility
{

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Dbh::getInstance();
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

    function getAllCars()
    {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $this->query($sql);
    }

    function getCarById($id) {
        $sql = "SELECT * FROM `vehicle` WHERE `vehicleId` = $id";
        return $this->query($sql);
    }

    function create(&$valueObject) {
        $sql =    '   INSERT  '.
            '   INTO  '.
            '     `vehicle`(  '.
            '       `vehicleId`,  '.
            '       `make`,  '.
            '       `yearMade`,  '.
            '       `model`,  '.
            '       `price`,  '.
            '       `mileage`,  '.
            '       `transmission`,  '.
            '       `drivetrain`,  '.
            '       `engineCapacity`,  '.
            '       `category`,  '.
            '       `cylinder`,  '.
            '       `doors`,  '.
            '       `status`,  '.
            '       `dateAdded`  '.
            '     )  '.
            '   VALUES(  '.
            '     '.$valueObject->getVehicleId().',  '.
            '     '.$valueObject->getMake().',  '.
            '     '.$valueObject->getYearMade().',  '.
            '     '.$valueObject->getModel().',  '.
            '     '.$valueObject->getPrice().',  '.
            '     '.$valueObject->getMileage().',  '.
            '     '.$valueObject->getTransmission().',  '.
            '     '.$valueObject->getDrivetrain().',  '.
            '     '.$valueObject->getEngineCapacity().',  '.
            '     '.$valueObject->getCategory().',  '.
            '     '.$valueObject->getCylinder().',  '.
            '     '.$valueObject->getDoors().',  '.
            '     '.$valueObject->getStatus().',  '.
            '     '.$valueObject->getDateAdded().'  '.
            '  );  ';
        // echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isCreated($postArray) {
        $lastCarId = $this->getLastCarId();
        // format price and mileage number
        $prices = $this->formatNumber($postArray["price"]);
        $mileages = $this->formatNumber($postArray["mileage"]);
        // a varchar type must be quoted in a string so we can insert it
        $car = new Vehicle(
            $this->incrementId($lastCarId),
            $this->stringValue($postArray["make"]),
            $postArray["year"],
            $this->stringValue($postArray["model"]),
            $this->stringValue($prices),
            $this->stringValue($mileages),
            $this->stringValue($postArray["transmission"]),
            $this->stringValue($postArray["drivetrain"]),
            $this->stringValue($postArray["capacity"]),
            $this->stringValue($postArray["category"]),
            $postArray["cylinder"],
            $postArray["doors"],
            $this->stringValue($postArray["status"]),
            $this->stringValue($this->getTimeStamp())
        );
        if($this->create($car)) {
            return 1;
        } else {
            return 0;
        }
    }

    function getSearchResult($searchArray) {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`\n"
            . "WHERE\n"
            . " make LIKE '%".$searchArray['searchMake']."%' \n"
            . " AND model LIKE '".$searchArray['searchModel']."' \n"
            . " AND yearMade BETWEEN ".$searchArray['minYear']." AND ".$searchArray['maxYear']." \n"
            . " AND (REPLACE(mileage, ',', '')) BETWEEN ".$searchArray['minMileage']." and ".$searchArray['maxMileage']."";
        return $this->query($sql);
    }

    // one car can have many photos
    function addDiagram($files, $id) {
        if(!empty($files)) {
            $sql = null;

            for($i = 0; $i < count($files); $i++) {
                $imageData = $files[$i];
                $sql .= "INSERT INTO `cardiagram`(`diagram`, `vehicleId`) VALUES ('{$imageData}',{$id});";
            }

            $db = Dbh::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }

    function isDiagramAdded($files, $id)
    {
        if ($this->isVehicleExist($id)) {
            if ($this->addDiagram($files, $id)) {
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }

    function update(&$carObject) {
        $u = new Utility(); // some of them needs to be a varchar (string)
        $sql =  '   UPDATE  '.
            '     `vehicle`  '.
            '   SET  '.
            '     `make` = '.$u->stringValue($carObject->getMake()).',  '.
            '     `yearMade` = '.$carObject->getYearMade().',  '.
            '     `model` = '.$u->stringValue($carObject->getModel()).',  '.
            '     `price` = '.$carObject->getPrice().',  '.
            '     `mileage` = '.$carObject->getMileage().',  '.
            '     `transmission` = '.$u->stringValue($carObject->getTransmission()).',  '.
            '     `drivetrain` = '.$u->stringValue($carObject->getDrivetrain()).',  '.
            '     `engineCapacity` = '.$u->stringValue($carObject->getEngineCapacity()).',  '.
            '     `category` = '.$u->stringValue($carObject->getCategory()).',  '.
            '     `cylinder` = '.$carObject->getCylinder().',  '.
            '     `doors` = '.$carObject->getDoors().',  '.
            '     `status` = '.$u->stringValue($carObject->getStatus()).',  '.
            '     `dateAdded` = '.$u->stringValue($carObject->getDateAdded()).'  '.
            '   WHERE  '.
            '    `vehicleId` =  ' . $carObject->getVehicleId();

        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isUpdated($postArray) {
        $id = $postArray['update-vehicle-id'];
        if($this->isVehicleExist($id)) {
            $updateThisCar_obj = new Vehicle(
                $id, // syntax: $postArray['nameAttribute']
                $postArray["update-make"],
                $postArray["year"],
                $postArray["update-model"],
                $postArray["price"],
                $postArray["mileage"],
                $postArray["transmission"],
                $postArray["drivetrain"],
                $postArray["capacity"],
                $postArray["category"],
                $postArray["cylinder"],
                $postArray["doors"],
                $postArray["status"],
                $this->getTimeStamp()
            );
            if($this->update($updateThisCar_obj)) {
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }

    function delete($id) {
        /**
         * Added ON DELETE CASCADE
         * since vehicleId is a
         * foreign key in cardiagram
         * table. The photos of this
         * vehicle being deleted
         * will also be deleted in
         * cardiagram table.
         */
        $sql = "DELETE FROM `vehicle` WHERE `vehicleId` = $id";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isDeleted($id) {
        if($this->isVehicleExist($id)) {
            if($this->delete($id)) {
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }

    function countAllCars() {
        return count($this->getAllCars());
    }

    function getLastCarId() {
        $sql = "SELECT vehicleId FROM `vehicle` ORDER BY vehicleid DESC LIMIT 1";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    function getLastDiagramId() {
        $sql = "SELECT cardiagram.diagramId FROM cardiagram ORDER BY cardiagram.diagramId DESC LIMIT 1";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    // for registration if username is taken {boolean}
    function isVehicleExist($id) {
        if (($this->getCarById($id))) {
            return 1;
        } else {
            return 0;
        }
    }



}