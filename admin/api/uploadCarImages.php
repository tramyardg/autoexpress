<?php
require_once '../server/CarDAO.php';
require_once '../server/DiagramDAO.php';

// car diagram upload with ajax
$v = new CarDAO();
if (isset($_GET["action"])) {
    if ($_GET["action"] === "uploadPhotos") {
        echo $is_uploaded = $v->isDiagramAdded(
            $_POST['filesData'], // array of images src to be uploaded
            $_GET["id"] // query string in the ajax url properties
        );
        exit();
    }
}