<?php
require_once '../server/CarDAO.php';
require_once '../server/DiagramDAO.php';

// car diagram upload with ajax
$v = new CarDAO();

if (isset($_POST)) {
    if (isset($_POST['fd']) && isset($_POST['id']) && isset($_POST['imgType'])) {
        echo $v->isDiagramAdded($_POST['fd'], $_POST['imgType'], $_POST['id']);
    }
}