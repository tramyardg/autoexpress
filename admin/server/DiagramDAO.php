<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-27
 * Time: 3:00 PM
 */
require_once 'class/Utility.php';
require_once 'class/Dbh.php';
require_once 'class/Diagram.php';
class DiagramDAO
{

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $diagram = array();

        // result mapping to class Diagram
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $diagram[] = new Diagram(
                $row['diagramId'],
                $row['diagram'],
                $row['vehicleId']
            );
        }
        $stmt = null;
        return $diagram;
    }

    function getAllPhotos() {
        $sql = "SELECT * FROM `cardiagram`";
        return $this->query($sql);
    }

    function getPhotosBy_Id($id) {
        $sql = "SELECT `diagramId`, `diagram`, `vehicleId` FROM `cardiagram` WHERE `diagramId` =" . $id .";";
        return $this->query($sql);
    }

    function getPhotosBy_CarId($id) {
        $sql = "SELECT `diagramId`, `diagram`, `vehicleId` FROM `cardiagram` WHERE `vehicleId` =" . $id .";";
        return $this->query($sql); // returns a diagram object
    }

    function countAllPhotosByCarId($id) {
        return count($this->getPhotosBy_CarId($id));
    }

    function isCarPhotoExist($id)
    {
        if (($this->getPhotosBy_Id($id))) {
            return 1;
        } else {
            return 0;
        }
    }

    function delete($id) {
        $sql = "DELETE FROM `cardiagram` WHERE `diagramId` = $id";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isDeleted($id) {
        if($this->isCarPhotoExist($id)) {
            if($this->delete($id)) {
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }


}