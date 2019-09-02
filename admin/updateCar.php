<?php
ob_start();
session_start();
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

    $q = new AdminDAO();
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);

    $v = new CarDAO();
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
    <title>AutoExpress - Raymart De Guzman</title>
    <meta name="title" content="AutoExpress - Raymart De Guzman">
    <meta name="description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta name="keywords" content="Raymart De Guzman, tramyardg.co.nf, tramyardg, PHP, car dealership, software engineer, car dealer, car buyer, AutoExpress.co.nf">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="AutoExpress - Raymart De Guzman">
    <meta property="og:description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta property="og:image" content="https://raw.githubusercontent.com/tramyardg/autoexpress/master/image/homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
	<link rel="stylesheet" href="css/datatables.min.css">
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
                    <li class="active">Manage Inventory > Update car</li>
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

                <div id="updateCarContainer"></div>

            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AddOrUpdateTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/routine/car-actions.js"></script>
<script src="js/app.js"></script>

<?php
if (isset($_GET['updateId']) && isset($_GET['h']))
{
    // cannot update a car without valid car id and hash
    $updateCarId = $_GET['updateId'];
    $toHash = $updateCarId;
    $toHash .= date("m.d.y");
    $hash = sha1($toHash);
    $canUpdate = false;
    if ($hash == $_GET['h'])
    {
        $v = new CarDAO();
        $updateCarInfoById = $v->getCarById($updateCarId);
        $updateCarInfo_data = json_encode($updateCarInfoById);
?>
<script>
  $(document).ready(() => {

    let checkedField = {
      field: function (modalContent, val, fieldElem) {
        let formField = modalContent.find(fieldElem);
        for (let i = 0; i < formField.length; i++) {
          if (fieldElem.indexOf("radio") === -1) {
            if (formField.eq(i).val() === val) {
              formField.eq(i).attr('selected', 'selected');
              break;
            } else {
              formField.eq(i).removeAttr('selected');
            }
          } else {
            if (formField.eq(i).val() === val) {
              formField.eq(i).attr('checked', 'true');
              break;
            }
          }
        }
      }
    };

    let carObj = <?php echo $updateCarInfo_data ?>;
    carObj = carObj[0];
    carObj._price = carObj._price.replace(/,/g, '');
    carObj._mileage = carObj._mileage.replace(/,/g, '');
    let options = {
      isForUpdate: true,
      id: carObj._vehicleId,
      make: carObj._make,
      model: carObj._model,
      year: carObj._yearMade,
      price: carObj._price,
      mileage: carObj._mileage,
      cylinder: carObj._cylinder,
      category: carObj._category,
      drivetrain: carObj._drivetrain,
      status: carObj._status,
      transmission: carObj._transmission,
      engineCapacity: carObj._engineCapacity,
      doors: carObj._doors
    };

    let adminUpdateCar = new AddOrUpdateTemplate(options);
    let updateCarContainerDiv = $('#updateCarContainer');

    updateCarContainerDiv.empty();
    updateCarContainerDiv.append(adminUpdateCar.addOrUpdateCar_Container());

    if (options.isForUpdate) {
      checkedField.field(updateCarContainerDiv, options.year, 'select#year option');
      checkedField.field(updateCarContainerDiv, options.cylinder, 'input[type=radio]#cylinder');
      checkedField.field(updateCarContainerDiv, options.category, 'input[type=radio]#category');
      checkedField.field(updateCarContainerDiv, options.drivetrain, 'input[type=radio]#drivetrain');
      checkedField.field(updateCarContainerDiv, options.status, 'input[type=radio]#status');
      checkedField.field(updateCarContainerDiv, options.transmission, 'input[type=radio]#transmission');
    }
    console.log(options);
  })
</script>
<?php
    }
}
?>

</body>
</html>