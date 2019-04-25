<?php
require_once '../server/CarDAO.php';
require_once '../server/DiagramDAO.php';

$v = new CarDAO();
if (isset($_GET["action"])) {
    if ($_GET["action"] === "updateCar") {
        $updateCarInfoById = $v->getCarById($_GET['id']);
        $updateCarInfo_data = json_encode($updateCarInfoById);
        echo $updateCarInfo_data;
        exit();
    }
}