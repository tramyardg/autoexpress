<?php
require_once '../server/CarDAO.php';
require_once '../server/DiagramDAO.php';

$v = new CarDAO();
if (isset($_GET["action"])) {
    if ($_GET["action"] === "delete") {
        echo ($v->isDeleted($_GET['id']) == true) ? '1' : '0';
        exit();
    }
}
