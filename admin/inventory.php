<?php
ob_start();
session_start();
require_once 'server/model/Enum.php';
require_once 'server/model/AdminLevel.php';
require_once 'server/AdminDAO.php';
require_once 'server/CarDAO.php';
require_once 'server/DiagramDAO.php';
require_once 'server/model/Admin.php';
require_once 'server/model/Paging.php';

$num_cars = null;
$rowCarField = null;
if (!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $p = new Paging();
    define('RECORDS_PER_PAGE', 5);
    $p->setRecordsPerPage(RECORDS_PER_PAGE);
    $p->setPageQueryStr('rowNumber');
    $p->setStartingRow($p->getPageRowNumber());

    $q = new AdminDAO();
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

    $adminLevel = $admin_data[0]->getAdminLevel();
    $levelArray = AdminLevel::splitAdminLevelArray(intval($adminLevel));
    $canRead = $canUpdate = $canInsert = $canDelete = '';
    if (is_array($levelArray)) {
        $canRead = in_array("READ", $levelArray) ? 'true' : 'false';
        $canUpdate = in_array("UPDATE", $levelArray) ? 'true' : 'false';
        $canInsert = in_array("INSERT", $levelArray) ? 'true' : 'false';
        $canDelete = in_array("DELETE", $levelArray) ? 'true' : 'false';
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
    <title>AutoExpress - Raymart De Guzman</title>
    <meta name="title" content="AutoExpress - Raymart De Guzman">
    <meta name="description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta name="keywords" content="Raymart De Guzman, tramyardg.co.nf, tramyardg, PHP, car dealership, software engineer, car dealer, car buyer, AutoExpress.co.nf">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta property="og:description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta property="og:image" content="https://raw.githubusercontent.com/tramyardg/autoexpress/master/image/homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
	<link rel="stylesheet" href="css/datatables.min.css">
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
                                    <?php
                                    $carId = $row['vehicleId'];
                                    $toHash = $carId;
                                    $toHash .= date("m.d.y");
                                    $hash = sha1($toHash);
                                    ?>
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
                                                    <?php if ($canUpdate == 'true') { ?>
                                                    <li>
                                                        <a href="updateCar.php?updateId=<?php echo $row['vehicleId'] . '&h=' . $hash; ?>">Update</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if ($canDelete == 'true') { ?>
                                                    <li>
                                                        <a class="delete-vehicle"
                                                           href="?id=<?php echo $row['vehicleId']; ?>"
                                                           delete="<?php echo $row['vehicleId']; ?>">Delete</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if ($canUpdate == 'true') { ?>
                                                    <li>
                                                        <a class="upload-car-photos"
                                                           href="?id=<?php echo $row['vehicleId']; ?>"
                                                           upload-delete-photos="<?php echo $row['vehicleId']; ?>">Manage
                                                            photo(s)</a>
                                                    </li>
                                                    <?php } ?>
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
                <?php if ($canInsert == 'true') { ?>
                <div class="row margin-bottom-15">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-success btn-sm" id="add-new-car-btn" data-toggle="modal"
                                data-target=".add-new-car-modal-lg">Add new
                        </button>
                    </div>
                </div>
                <?php } ?>

                <!-- modal template for adding vehicle info -->
                <?php if ($canInsert == 'true') { ?>
                <div class="modal fade add-new-car-modal-lg " tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" id="add-car-info-modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Vehicle</h4>
                            </div>
                            <div style="padding: 1em;" id="addCarContainer"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <!-- modal template for uploading and updating photos -->
    <?php if ($canUpdate == 'true') { ?>
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
                        <form id="add-car-photos-form" enctype="multipart/form-data">
                            <div class="panel panel-info">
                                <div class="panel-heading">Upload photos for this car</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><b>Note</b>: Only image file types are allowed to be
                                                uploaded, otherwise it will not work.</p>
                                            <input type="file" id="files" name="files[]" multiple/>
                                            <output id="list"></output>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" name="upload-car-photos-btn" value="Submit" carid="null" />
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
    <?php } ?>

</div>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/routine/car-actions.js"></script>
<script src="js/app.js"></script>

<script src="js/common/AddOrUpdateTemplate.js"></script>
<script type="text/javascript">
  let adminAddCar = new AddOrUpdateTemplate('null');
  let addCarContainerDiv = $('#addCarContainer');
  addCarContainerDiv.empty();
  addCarContainerDiv.append(adminAddCar.addOrUpdateCar_Container());

  function previewSelectedImages(evt) {
    let files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (let i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      let reader = new FileReader();
      // Closure to capture the file information.
      reader.onload = (function (theFile) {
        return function (e) {
          // Render thumbnail.
          let span = document.createElement('span');
          span.innerHTML = ['<img model="thumb" id="car-image-' + i + '" src="', e.target.result,
            '" title="', theFile.name, '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('files').addEventListener('change', previewSelectedImages, false);
</script>

</body>
</html>