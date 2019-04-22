<?php
ob_start();
session_start();
require_once 'server/AdminDAO.php';
require_once 'server/CarDAO.php';
require_once 'server/DiagramDAO.php';
require_once 'server/class/Admin.php';
require_once 'server/class/Paging.php';

$num_cars = null;
$rowCarField = null;
if (!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $p = new Paging();
    define('RECORDS_PER_PAGE', 2);
    $p->setRecordsPerPage(RECORDS_PER_PAGE);
    $p->setPageQueryStr('rowNumber');
    $p->setStartingRow($p->getPageRowNumber());

    $q = new AdminDAO();
    if (isset($_REQUEST['username'])) {
        $q->redirectNotFoundAdmin($_REQUEST['username']);
    }
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);

    $v = new CarDAO();
    $all_cars = $v->getAllCars();
    $num_cars = $v->countAllCars();
    $rowCarField = $v->getCarsLimitByRecPerPage($p->getStartingRow(), $p->getRecordsPerPage());

    // adding general car info
    if (!empty($_POST['add-car-submit'])) {
        $isAddedCondition = $v->isCreated($_POST);
    }

    // displaying a car photos for deletion  with ajax
    $d = new DiagramDAO();
    if (isset($_GET['action'])) {
        if ($_GET['action'] === "getPhotosByCarId") {
            $diagram = $d->getPhotosBy_CarId($_GET['id']);
            $diagramJson = json_encode($diagram);
            echo $diagramJson; // sent to ajax don't remove
            exit();
        }
    }

    // deleting a car photo
    if (isset($_GET["action"])) {
        if ($_GET["action"] === "deleteCarPhoto") {
            $isDeletedPhoto = $d->isDeleted($_GET["id"]);
        }
    }

    // loading data to modal update with ajax
    if (isset($_GET["action"])) {
        if ($_GET["action"] === "updateCarInfo") {
            $updateCarInfoById = $v->getCarById($_GET['id']);
            $updateCarInfo_data = json_encode($updateCarInfoById);
            echo $updateCarInfo_data; // sent to ajax call
            exit();
        }
    }

    // updating general car info
    if (!empty($_POST['update-car-submit'])) {
        $isUpdatedCondition = $v->isUpdated($_POST);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Primary Meta Tags -->
    <title>AutoExpress.co.nf - Raymart De Guzman</title>
    <meta name="title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta name="description" content="Autoexpress.co.nf is a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta name="keywords" content="Raymart De Guzman, tramyardg.co.nf, tramyardg, PHP, car dealership, software engineer, car dealer, car buyer, AutoExpress.co.nf">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://autoexpress.co.nf"/>
    <meta property="og:title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta property="og:description" content="Autoexpress.co.nf is a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta property="og:image" content="https://raw.githubusercontent.com/tramyardg/autoexpress/master/image/homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">-->
    <style>
        .input-required {
            color: red;
        }
        #car-general-info-table tbody tr td input,
        table tbody tr td input, select {
            margin: 2px 0 2px 3px;
        }
    </style>
</head>
<body>
<div id="main-wrapper">
    <div class="loader"></div>
    <div class="template-page-wrapper">
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Manage Inventory</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" title="admin id"
                       value="<?php echo $admin_data[0]->getUsername(); ?>">
                <h1>Manage Vehicles</h1>
                <?php if (isset($isAddedCondition) && $isAddedCondition === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <?php if (isset($isDeletedPhoto) && $isDeletedPhoto === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <?php if (isset($isUpdatedCondition) && $isUpdatedCondition === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <!-- car table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="vehicle-table" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Price ($)</th>
                                    <th>Status</th>
                                    <th>Mileage (Kms)</th>
                                    <th>Transmission</th>
                                    <th>Drivetrain</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $rowCarField->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $row['yearMade']; ?></td>
                                        <td><?php echo $row['make'];?></td>
                                        <td><?php echo $row['model']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['mileage']; ?></td>
                                        <td><?php echo $row['transmission']; ?></td>
                                        <td><?php echo $row['drivetrain']; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Actions
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a data-target="#updateCarInfoModal" data-toggle="modal"
                                                           data-id="<?php echo $row['vehicleId']; ?>"
                                                           href="#updateCarInfoModal">Update</a></li>
                                                    <li><a class="delete-vehicle"
                                                           href="?id=<?php echo $row['vehicleId']; ?>"
                                                           delete="<?php echo $row['vehicleId']; ?>">Delete</a>
                                                    </li>
                                                    <li><a class="upload-car-photos"
                                                           href="?id=<?php echo $row['vehicleId']; ?>"
                                                           upload-delete-photos="<?php echo $row['vehicleId']; ?>">Upload
                                                            / Delete photo(s)</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="<?php if($num_cars <= $p->getRecordsPerPage()) {echo 'hidden';} ?>">
                                <ul class="pagination">
                                    <?php if($num_cars > $p->getRecordsPerPage()) { ?>
                                        <?php if($p->getPrev() >= 0) { ?>
                                            <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $p->getPrev(); ?>">Previous</a></li>
                                        <?php } ?>
                                        <?php $pageNumber = 1; ?>
                                        <?php for($i = 0; $i < $num_cars; $i = $i + $p->getRecordsPerPage()) { ?>
                                            <?php if($i != $p->getStartingRow()) { ?>
                                                <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                                            <?php } else { ?>
                                                <li class="page-item active"><a href="inventory.php?rowNumber=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                                            <?php } ?>
                                            <?php $pageNumber = $pageNumber + 1; ?>
                                        <?php } ?>
                                        <?php if($p->getNext() < $num_cars) { ?>
                                            <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $p->getNext(); ?>">Next</a></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>

                <!-- add new car button -->
                <div class="row margin-bottom-15">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-success btn-sm" id="add-new-car-btn" data-toggle="modal"
                                data-target=".add-new-car-modal-lg">Add new
                        </button>
                    </div>
                </div>

                <!-- modal template for adding vehicle info -->
                <div class="modal fade add-new-car-modal-lg " tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" id="add-car-info-modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Vehicle</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post" onsubmit="" class="margin-top-15">
                                        <!-- general vehicle info -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">General vehicle info</div>
                                            <div class="panel-body">
                                                <table cellspacing="1" id="car-general-info-table">
                                                    <tbody>
                                                    <tr>
                                                        <td>Make<span class="input-required"> *</span></td>
                                                        <td>
                                                            <select title="make" name="make" id="make" class=""
                                                                    onchange="new CommonUtil().selectCarMake(this);"
                                                                    required>
                                                                <option selected="selected" value="">Select Make
                                                                </option>
                                                                <option value="Acura">Acura</option>
                                                                <option value="Alfa Romeo">Alfa Romeo</option>
                                                                <option value="Aston Martin">Aston Martin</option>
                                                                <option value="Audi">Audi</option>
                                                                <option value="Bentley">Bentley</option>
                                                                <option value="BMW">BMW</option>
                                                                <option value="Buick">Buick</option>
                                                                <option value="Cadillac">Cadillac</option>
                                                                <option value="Chevrolet">Chevrolet</option>
                                                                <option value="Chrysler">Chrysler</option>
                                                                <option value="Dodge">Dodge</option>
                                                                <option value="Ferrari">Ferrari</option>
                                                                <option value="FIAT">Fiat</option>
                                                                <option value="Ford">Ford</option>
                                                                <option value="GMC">GMC</option>
                                                                <option value="Honda">Honda</option>
                                                                <option value="Hyundai">Hyundai</option>
                                                                <option value="Infiniti">Infiniti</option>
                                                                <option value="Isuzu">Isuzu</option>
                                                                <option value="Jaguar">Jaguar</option>
                                                                <option value="Jeep">Jeep</option>
                                                                <option value="Kia">Kia</option>
                                                                <option value="Lamborghini">Lamborghini</option>
                                                                <option value="Land Rover">Land Rover</option>
                                                                <option value="Lexus">Lexus</option>
                                                                <option value="Lincoln">Lincoln</option>
                                                                <option value="Lotus">Lotus</option>
                                                                <option value="Maserati">Maserati</option>
                                                                <option value="Mazda">Mazda</option>
                                                                <option value="Mercedes-Benz">Mercedes-Benz</option>
                                                                <option value="Mini">Mini</option>
                                                                <option value="Mitsubishi">Mitsubishi</option>
                                                                <option value="Nissan">Nissan</option>
                                                                <option value="Pontiac">Pontiac</option>
                                                                <option value="Porsche">Porsche</option>
                                                                <option value="Ram">Ram</option>
                                                                <option value="Saab">Saab</option>
                                                                <option value="Saturn">Saturn</option>
                                                                <option value="Scion">Scion</option>
                                                                <option value="Smart">Smart</option>
                                                                <option value="Subaru">Subaru</option>
                                                                <option value="Suzuki">Suzuki</option>
                                                                <option value="Tesla">Tesla</option>
                                                                <option value="Toyota">Toyota</option>
                                                                <option value="Volkswagen">Volkswagen</option>
                                                                <option value="Volvo">Volvo</option>
                                                            </select>
                                                            <b style="font-size: 10px; color: red;"
                                                               id="make-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year<span class="input-required"> *</span></td>
                                                        <td>
                                                            <select name="year" id="year" title="year" required>
                                                                <option selected="selected" value="">Select year
                                                                </option>
                                                                <option value="2019">2019</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2014">2014</option>
                                                                <option value="2013">2013</option>
                                                                <option value="2012">2012</option>
                                                                <option value="2011">2011</option>
                                                                <option value="2010">2010</option>
                                                                <option value="2009">2009</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2007">2007</option>
                                                                <option value="2006">2006</option>
                                                                <option value="2005">2005</option>
                                                                <option value="2004">2004</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2001">2001</option>
                                                                <option value="2000">2000</option>
                                                                <option value="1999">1999</option>
                                                                <option value="1998">1998</option>
                                                                <option value="1997">1997</option>
                                                                <option value="1996">1996</option>
                                                                <option value="1995">1995</option>
                                                                <option value="1994">1994</option>
                                                                <option value="1993">1993</option>
                                                                <option value="1992">1992</option>
                                                                <option value="1991">1991</option>
                                                                <option value="1990">1990</option>
                                                                <option value="1989">1989</option>
                                                                <option value="1988">1988</option>
                                                                <option value="1987">1987</option>
                                                                <option value="1986">1986</option>
                                                                <option value="1985">1985</option>
                                                                <option value="1984">1984</option>
                                                                <option value="1983">1983</option>
                                                                <option value="1982">1982</option>
                                                                <option value="1981">1981</option>
                                                                <option value="1980">1980</option>
                                                            </select>
                                                            <b style="font-size: 10px; color: red;"
                                                               id="year-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model<span class="input-required"> *</span></td>
                                                        <td>
                                                            <select name="model" id="model" title="model" required>
                                                                <option selected="selected">Select model</option>
                                                            </select>
                                                            <b style="font-size: 10px; color: red;" id="model-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Price<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input type="number" name="price" id="price"
                                                                   title="price" min="0" max="999999" required/>
                                                            <b style="font-size: 10px; color: red;" id="price-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mileage(Km)<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input type="number" name="mileage" id="mileage"
                                                                   title="mileage" min="0" max="999999" required/>
                                                            <b style="font-size: 10px;  color: red;"
                                                               id="mileage-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transmission<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input type="radio" name="transmission"
                                                                   id="transmission" value="Automatic"
                                                                   title="transmission" required checked> Automatic
                                                            <input type="radio" name="transmission"
                                                                   id="transmission" value="Manual"
                                                                   title="transmission" required> Manual
                                                            <b style="font-size: 10px; color: red;"
                                                               id="transmission-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Drivetrain<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input type="radio" name="drivetrain" id="drivetrain"
                                                                   value="AWD" title="drivetrain" required> AWD
                                                            <input type="radio" name="drivetrain" id="drivetrain"
                                                                   value="FWD" title="drivetrain" required> FWD
                                                            <input type="radio" name="drivetrain" id="drivetrain"
                                                                   value="RWD" title="drivetrain" required> RWD
                                                            <input type="radio" name="drivetrain" id="drivetrain"
                                                                   value="4X4" title="drivetrain" required> 4X4
                                                            <b style="font-size: 10px; color: red;"
                                                               id="drivetrain-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>
                                                            <input type="radio" name="status" id="status"
                                                                   value="Available" title="status" checked>
                                                            Available
                                                            <input type="radio" name="status" id="status"
                                                                   value="SOLD" title="status"> Sold
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <span class="input-required">*</span> <span
                                                        class="label label-danger">Required fields</span>
                                            </div>
                                        </div>

                                        <!-- category and photos -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Category</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <b>Car</b><br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Subcompact car"> Subcompact car <br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Compact car"> Compact car <br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Mid-size car"> Mid-size car <br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Entry-level luxury car"> Entry-level luxury
                                                        car <br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Mid-size luxury car"> Mid-size luxury car
                                                        <br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Full-size car"> Full-size car
                                                    </div>
                                                    <div class="col-md-5">
                                                        <b>Truck</b><br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Minivan"> Minivan<br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Van"> Van<br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Compact SUV"> Compact SUV<br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Mid-size SUV"> Mid-size SUV<br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Full-size SUV"> Full-size SUV<br/>
                                                        <input required class="right_side" type="radio"
                                                               name="category" id="category" title="category"
                                                               value="Pickup"> Pickup
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <span class="input-required">*</span> <span
                                                        class="label label-danger">Required fields</span>
                                            </div>
                                        </div>

                                        <!-- engine and chassis -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Engine and chassis</div>
                                            <div class="panel-body">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td>Cylinder<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input required type="radio" name="cylinder"
                                                                   id="cylinder" title="cylinder" value="4"> 4
                                                            <input required type="radio" name="cylinder"
                                                                   id="cylinder" title="cylinder" value="6"> V6
                                                            <input required type="radio" name="cylinder"
                                                                   id="cylinder" title="cylinder" value="8"> V8
                                                            <input required type="radio" name="cylinder"
                                                                   id="cylinder" title="cylinder" value="10"> V10
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Capacity (Litre) <span class="input-required"> *</span>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="capacity" id="capacity"
                                                                   minlength="0" maxlength="4" title="capacity"
                                                                   required>
                                                            <b style="font-size: 10px; color: red;"
                                                               id="capacity-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Doors<span class="input-required"> *</span></td>
                                                        <td>
                                                            <input type="number" name="doors" id="doors"
                                                                   title="doors" required min="2" max="6">
                                                            <b style="font-size: 10px; color: red;"
                                                               id="door-err">&nbsp;</b>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <span class="input-required">*</span> <span
                                                        class="label label-danger">Required fields</span>
                                            </div>
                                        </div>

                                        <!-- submit and cancel buttons -->
                                        <div class="panel panel-success">
                                            <div class="panel-heading">Submit form</div>
                                            <div class="panel-body">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" class="btn btn-primary btn-sm"
                                                                   name="add-car-submit" id="add-car-submit"
                                                                   value="Submit">
                                                            <input type="button" class="btn btn-default btn-sm"
                                                                   data-dismiss="modal" aria-label="Close"
                                                                   value="Cancel">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal template for updating vehicle info -->
                <div class="modal fade updateCarInfoModal" id="updateCarInfoModal" tabindex="-1" role="dialog"
                     aria-labelledby="updateCarInfoModal">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Updating Vehicle Info</h4>
                            </div>
                            <div id="update-car-info-modal-content"></div>
                        </div>
                    </div>
                </div>

                <!-- modal template for uploading and updating photos -->
                <div class="modal fade bs-example-modal-sm" id="upload-delete-car-photos-modal" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Upload or Delete Photos for this Vehicle</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12 margin-top-15">
                                    <div class="col-md-12">
                                        <div class="panel panel-warning">
                                            <div class="panel-heading">Deleting photos...</div>
                                            <div class="panel-body" id="display-images-by-this-car"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post" id="add-car-photos-form"
                                              enctype="multipart/form-data" class="">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Upload photos for this car</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><b>Note</b>: Only image file types are allowed to be
                                                                uploaded, otherwise it will not work.</p>
                                                            <input type="file" id="files" name="files[]" multiple/>
                                                            <output id="list"></output>
                                                            <script>
                                                                function handleFileSelect(evt) {
                                                                    var files = evt.target.files; // FileList object

                                                                    // Loop through the FileList and render image files as thumbnails.
                                                                    for (var i = 0, f; f = files[i]; i++) {

                                                                        // Only process image files.
                                                                        if (!f.type.match('image.*')) {
                                                                            continue;
                                                                        }

                                                                        var reader = new FileReader();

                                                                        // Closure to capture the file information.
                                                                        reader.onload = (function (theFile) {
                                                                            return function (e) {
                                                                                // Render thumbnail.
                                                                                var span = document.createElement('span');
                                                                                span.innerHTML = ['<img class="thumb" id="car-image-' + i + '" src="', e.target.result,
                                                                                    '" title="', theFile.name, '"/>'].join('');
                                                                                document.getElementById('list').insertBefore(span, null);
                                                                            };
                                                                        })(f);

                                                                        // Read in the image file as a data URL.
                                                                        reader.readAsDataURL(f);
                                                                    } // end for
                                                                }

                                                                document.getElementById('files').addEventListener('change', handleFileSelect, false);
                                                            </script>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                    id="upload-car-photos-btn">Upload
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js"></script>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/routine/car-actions.js"></script>
<script src="js/app.js"></script>

</body>
</html>