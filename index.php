<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';
require_once 'admin/server/AdvanceSearch.php';

$v = new CarDAO();
$d = new DiagramDAO();
$numCars = $v->countAllCars();

$page = null;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
if(!isset($_GET['page'])){
    $page = 0;
}

$startingPoint = $page;

$recordsPerPage = 2;
$prev = $startingPoint - $recordsPerPage;
$next = $startingPoint + $recordsPerPage;


$vehicleObj = $v->getCarsByNumRecords($startingPoint, $recordsPerPage);

$s = new AdvanceSearch(); // search result
$s->getSearchInputResult('search-car');
echo $s->resultFoundMessage();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress.com</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" >
</head>
<body>
<div class="container_custom">
    <?php include 'template/header.php'; ?>
    <?php include 'template/advance-search.php'; ?>
    
	<div class="content">
        <div class="content-car-section">
            <?php ?>

            <table id="inventory-vehicle-table">
                <thead>
                    <tr>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php  while($row = $vehicleObj->fetch())  { ?>
                        <tr>
                            <td>
                                <div class="divTable" id="car-item-<?php  ?>">
                                    <div class="divTableBody">
                                        <div class="divTableRow">
                                            <div class="divTableCell">
                                                <div class="row car-images" >
                                                    <?php
                                                    // first if stmt: use 'place hold' it as image if this car has no images
                                                    // second if stmt: no badge for car that has no images
//                                                    $currCarImg = $d->getPhotosBy_CarId($vehicleObj[$i]->getVehicleId());
//                                                    if($d->countAllPhotosByCarId($vehicleObj[$i]->getVehicleId()) == "0") {
                                                        $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
//                                                    } else {
//                                                        $h = $currCarImg[0]->getDiagram();
//                                                    }
                                                    ?>
                                                    <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>">
                                                        <span class="badge"></span>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="feature_links">
                                                    <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                       data-target="#calculatePaymentModal" data-price="<?php echo $row['price']; ?>" >
                                                        <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                                                    </a>
                                                    <a href="<?php echo 'details.php?carId='.$row['vehicleId']; ?>" title="View more details">
                                                        <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="car_info">
                                                    <p>
                                                        <span class="car-title"><?php ?> - </span>
                                                        <span class="price-style">$<?php echo $row['price']; ?></span>
                                                    </p>
                                                    <p><span class="availability"><?php echo $row['status']; ?></span></p>
                                                    <p>
                                                        <span class="mileage"><?php echo $row['mileage']; ?> km</span>&nbsp;|&nbsp;
                                                        <span class="transmission"><?php echo $row['transmission']; ?></span>&nbsp;|&nbsp;
                                                        <span class="drivetrain"><?php echo $row['drivetrain']; ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php   } ?>


                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($numCars > $recordsPerPage) { ?>
                        <?php if($prev >= 0) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $prev; ?>">Previous</a></li>
                        <?php } ?>
                        <?php $pageNumber = 1; ?>
                        <?php for($i = 0; $i < $numCars; $i = $i + $recordsPerPage) { ?>
                            <?php if($i != $startingPoint) { ?>
                                <li class="page-item"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } else { ?>
                                <li class="page-item active"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } ?>
                            <?php $pageNumber = $pageNumber + 1; ?>
                        <?php } ?>
                        <?php if($next < $numCars) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $next; ?>">Next</a></li>
                        <?php } ?>
                    <?php } ?>

                </ul>
            </nav>

        </div>


        <?php include 'template/payment-modal.php'; ?>

    </div>
    <?php include 'template/footer.php'; ?>
	
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/PaymentCalculator.js"></script>
<script>
    $(document).ready(function () {
       PaymentCalculator.init();
//        $('#inventory-vehicle-table').DataTable({
//            "pageLength": 3,
//            "lengthChange": false,
//            searching: false,
//            "ordering": false
//        });
    });
    function selectCarMakeFn(selectedMake) {
        var modelsSelect = $(selectedMake).parent().next().find('#searchModel');
        modelsSelect.empty();
        var selectVal = $(selectedMake).val();
        modelsSelect.append('<option selected value="%">Select model</option>');
        $.ajax({
            type: "GET",
            url: "admin/js/data/models.json",
            dataType: "json",
            success: function (json) {
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        if(selectVal === json[key].title) {
                            var modelsObj = json[key].models;
                            Object.keys(modelsObj).forEach(function(key) {
                                var h = '<option value="'+modelsObj[key].value+'" title="'+modelsObj[key].title+'">'+modelsObj[key].value+'</option>';
                                modelsSelect.append(h);
                            });
                            break;
                        }
                    }
                }
            }
        });
    }
</script>
</body>
</html>