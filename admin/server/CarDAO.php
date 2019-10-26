<?php

require_once 'model/Utility.php';
require_once 'model/Dbh.php';
require_once 'model/Vehicle.php';
/**
 *
 * Contains managing data query functions
 * - add vehicle
 * - delete vehicle
 * - update vehicle
 * - select vehicle by id
 * - select all vehicle
 * - advanced search
 *
 */
class CarDAO extends Utility
{

    // mostly used for select queries, mapping results to a model
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

    /**
     * Mainly used for pagination.
     * Does not return a car object.
     * usage:
     *  while($row['colName'] = fetch()) {}
     * @param $rowStart
     * @param $numRecordsPerPage
     * @return PDOStatement
     */
    function getCarsLimitByRecPerPage($rowStart, $numRecordsPerPage) {
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
            .  " CONCAT(`yearMade`,\n"
            . " ' ',\n"
            . " `make`,\n"
            . " ' ',\n"
            . " `model`) AS `vehicleTitle`\n"
            . "FROM\n"
            . " `vehicle`\n"
            . "LIMIT $rowStart, $numRecordsPerPage";
        //echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    /**
     * ALPHA
     * get vehicle with images all at one query
     * instead of two (no need to use DiagramDAO)
     * returns unique vehicle id since
     * vehicle can have more than one image
     * Problem diagramId and diagram is
     * not map since query() only returns 
	 * a car object.
     * 
     * Suggestion
     * You can add diagramId, and diagram
     * properties in vehicle entity.
     */
    function getVehiclesWithPhotos() {
        $sql = "SELECT\n"
            . " vehicle.vehicleId, vehicle.make, vehicle.yearMade,\n"
            . " vehicle.model, vehicle.price, vehicle.mileage,\n"
            . " vehicle.transmission, vehicle.drivetrain,\n"
            . " vehicle.engineCapacity, vehicle.category, vehicle.cylinder,\n"
            . " vehicle.doors, vehicle.status, vehicle.dateAdded,\n"
            . " cardiagram.diagramId, cardiagram.diagram\n"
            . "FROM\n"
            . " cardiagram\n"
            . "RIGHT JOIN\n"
            . " vehicle ON cardiagram.vehicleId = vehicle.vehicleId\n"
            . "GROUP BY\n"
            . " vehicle.vehicleId;";
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
        // a varchar type must be quoted in a string so we can insert it
        $car = new Vehicle(
            $this->incrementId($lastCarId),
            $this->stringValue($postArray["make"]),
            $postArray["year"],
            $this->stringValue($postArray["model"]),
            $this->formatNumber($postArray["price"]),
            $this->formatNumber($postArray["mileage"]),
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

    // one car can have many photos
    function addDiagram($files, $imgTypes, $id) {
        if(!empty($files)) {
            $sql = null;

            for($i = 0; $i < count($files); $i++) {
                $imageData = $files[$i];
                $imageType = $imgTypes[$i];
                $sql .= "INSERT INTO `cardiagram`(`diagram`, `vehicleId`, `imageType`) VALUES ('{$imageData}',{$id}, '{$imageType}');";
            }

            $db = Dbh::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt;
        } else {
            return null;
        }
    }

    function isDiagramAdded($files, $imgTypes, $id) {
        return $this->addDiagram($files, $imgTypes, $id) ? 1 : 0;
    }

    function update(&$carObject) {
        // some of them needs to be a varchar (string)
        $sql =  '   UPDATE  '.
            '     `vehicle`  '.
            '   SET  '.
            '     `make` = '.$this->stringValue($carObject->getMake()).',  '.
            '     `yearMade` = '.$carObject->getYearMade().',  '.
            '     `model` = '.$this->stringValue($carObject->getModel()).',  '.
            '     `price` = '.$carObject->getPrice().',  '.
            '     `mileage` = '.$carObject->getMileage().',  '.
            '     `transmission` = '.$this->stringValue($carObject->getTransmission()).',  '.
            '     `drivetrain` = '.$this->stringValue($carObject->getDrivetrain()).',  '.
            '     `engineCapacity` = '.$this->stringValue($carObject->getEngineCapacity()).',  '.
            '     `category` = '.$this->stringValue($carObject->getCategory()).',  '.
            '     `cylinder` = '.$carObject->getCylinder().',  '.
            '     `doors` = '.$carObject->getDoors().',  '.
            '     `status` = '.$this->stringValue($carObject->getStatus()).',  '.
            '     `dateAdded` = '.$this->stringValue($carObject->getDateAdded()).'  '.
            '   WHERE  '.
            '    `vehicleId` =  ' . $carObject->getVehicleId();
        // echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isUpdated($postArray)
    {
        $id = $postArray['update-vehicle-id'];
        if (($this->getCarById($id))) {
            $updateThisCar_obj = new Vehicle(
                $id, // syntax: $postArray['nameAttribute']
                $postArray["update-make"],
                $postArray["year"],
                $postArray["update-model"],
                $this->formatNumber($postArray["price"]),
                $this->formatNumber($postArray["mileage"]),
                $postArray["transmission"],
                $postArray["drivetrain"],
                $postArray["capacity"],
                $postArray["category"],
                $postArray["cylinder"],
                $postArray["doors"],
                $postArray["status"],
                $this->getTimeStamp()
            );
            if ($this->update($updateThisCar_obj)) {
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
        if ($this->delete($id)) {
            return 1;
        } else {
            return 0;
        }
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

}