<?php
require_once '../server/CarDAO.php';
require_once '../server/DiagramDAO.php';

// car diagram upload with ajax
$v = new CarDAO();
if (isset($_POST)) {
    echo 'hello....';
    print_r($_POST);
    var_dump(file_get_contents('php://input'));
    // echo $this->addDiagram($_POST['filesData'], $_GET["id"]) != null ? 1 : 0;
    // exit();
}