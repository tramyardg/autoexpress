<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';

$v = new CarDAO();
$d = new DiagramDAO();

if(isset($_GET['carId']) && $v->isVehicleExist($_GET['carId'])) {
    $carId = $_GET['carId'];
    $currCar = $v->getCarById($carId); // current car [0]
    $num_img = $d->countAllPhotosByCarId($carId);

    $currCarImg = $d->getPhotosBy_CarId($carId);
} else {
    header('Location: index.php');
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress.com</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/print-preview.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container_custom">
    <div class="header">
        <div>Your <span class="orange-logo-text">Logo</span> Here</div>
        <div class="clear-both"></div>
        <div class="menu-header">
            <div id="menu-header-left-section">
                <span><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a></span>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
</div>
<div id="details-container">
    <div id="content_section">
        <div id="vehicle_title"><h3><?php echo $currCar[0]->getHeadingTitle(); ?></h3></div>
        <div style="clear: both" ></div>
        <div class="left_section">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $h = null; ?>
                    <?php for($i = 0; $i < $num_img; $i++) { ?>
                        <?php if($i == 0) { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'; ?>
                        <?php } else { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>'; ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $h; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $ht = null; ?>
                    <?php for($j = 0; $j < $num_img; $j++) { ?>
                        <?php if($j == 0) { ?>
                            <?php
                            $ht .= '<div class="item active">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } else { ?>
                            <?php
                            $ht .= '<div class="item">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $ht; ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-arrow-left fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-arrow-right fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br><h3><span>Notes</span></h3>
            <textarea id="note-text" rows="8" name="notes"></textarea>
        </div>
        <div class="right_section">
            <div id="vehicle_info">
                <div id="vehicle_info_left">
                    <p>Price</p>
                    <p>Make</p>
                    <p>Model</p>
                    <p>Year</p>
                    <p>Kilometers</p>
                    <p>Transmission</p>
                    <p>Stock Number</p>
                    <p>Drivetrain</p>
                    <p>Exterior Colour</p>
                    <p>Interior Colour</p>
                    <p>Category</p>
                    <p>Cylinders</p>
                    <p>Fuel type</p>
                    <p>Doors</p>
                    <p>Engine Capacity</p>
                    <p>Safety Rating</p>
                </div>
                <div id="vehicle_info_right">
                    <p>$22000</p>
                    <p>Toyota</p>
                    <p>Rav4</p>
                    <p>2010</p>
                    <p>113212</p>
                    <p>Automatic</p>
                    <p>-</p>
                    <p>AWD</p>
                    <p>-</p>
                    <p>-</p>
                    <p>SUV</p>
                    <p>4</p>
                    <p>-</p>
                    <p>5</p>
                    <p>2.5 L</p>

                    <p>N/A</p>
                </div>
                <div style="clear: both" ></div>
            </div>
        </div>
        <div style="clear: both" ></div>
        <button id="print-btn" onclick="window.print()">Print</button>
    </div>
</div><!-- end container -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>