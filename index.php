<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';
require_once 'admin/server/AdvanceSearchDAO.php';
require_once 'admin/server/class/Paging.php';

$v = new CarDAO();
$d = new DiagramDAO();
$s = new AdvanceSearchDAO();
$numberOfCars = $v->countAllCars();

$p = new Paging();
define('RECORDS_PER_PAGE', 1);
$p->setRecordsPerPage(RECORDS_PER_PAGE);
$p->setPageQueryStr('page');
$p->setStartingRow($p->getPageRowNumber());


$rowCarField = $v->getCarsLimitByRecPerPage($p->getStartingRow(), $p->getRecordsPerPage());
$carObjSearchResult = $s->getSearchInputResult('search-car');
//print_r($carObjSearchResult);
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

            <?php $hideIndexResult = empty($carObjSearchResult) ? "visible" : "hidden"; ?>
            <table id="inventory-vehicle-table"  class="<?php echo $hideIndexResult; ?>" >
                <thead>
                    <tr>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php  while($row = $rowCarField->fetch())  { ?>
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
                                                    $currSearchCarImg = $d->getPhotosBy_CarId($row['vehicleId']);
                                                    if($d->countAllPhotosByCarId($row['vehicleId']) == "0") {
                                                        $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                    } else {
                                                        $h = $currSearchCarImg[0]->getDiagram();
                                                    }
                                                    ?>
                                                    <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>"><span class="badge"></span>
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
            <nav aria-label="Page navigation example" class="<?php echo $hideIndexResult; ?>">
                <ul class="pagination">
                    <?php if($numberOfCars > $p->getRecordsPerPage()) { ?>
                        <?php if($p->getPrev() >= 0) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $p->getPrev(); ?>">Previous</a></li>
                        <?php } ?>
                        <?php $pageNumber = 1; ?>
                        <?php for($i = 0; $i < $numberOfCars; $i = $i + $p->getRecordsPerPage()) { ?>
                            <?php if($i != $p->getStartingRow()) { ?>
                                <li class="page-item"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } else { ?>
                                <li class="page-item active"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } ?>
                            <?php $pageNumber = $pageNumber + 1; ?>
                        <?php } ?>
                        <?php if($p->getNext() < $numberOfCars) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $p->getNext(); ?>">Next</a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </nav>

            <?php if(!empty($carObjSearchResult)) { ?>
            <!-- search result -->
            <table id="search-result-vehicle-table">
                <thead>
                <tr>
                    <th>
                        <?php echo $s->getResultFoundMessage(); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php  while($rowSearchResult = $carObjSearchResult->fetch())  { ?>
                    <tr >
                        <td>
                            <div class="divTable" id="car-item-<?php  ?>">
                                <div class="divTableBody">
                                    <div class="divTableRow">
                                        <div class="divTableCell">
                                            <div class="row car-images" >
                                                <?php
                                                // first if stmt: use 'place hold' it as image if this car has no images
                                                // second if stmt: no badge for car that has no images
                                                $currSearchCarImg = $d->getPhotosBy_CarId($rowSearchResult['vehicleId']);
                                                if($d->countAllPhotosByCarId($rowSearchResult['vehicleId']) == "0") {
                                                    $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                } else {
                                                    $h = $currSearchCarImg[0]->getDiagram();
                                                }
                                                ?>
                                                <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>"><span class="badge"></span>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="feature_links">
                                                <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                   data-target="#calculatePaymentModal" data-price="<?php echo $rowSearchResult['price']; ?>" >
                                                    <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                                                </a>
                                                <a href="<?php echo 'details.php?carId='.$rowSearchResult['vehicleId']; ?>" title="View more details">
                                                    <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="car_info">
                                                <p>
                                                    <span class="car-title"><?php ?> - </span>
                                                    <span class="price-style">$<?php echo $rowSearchResult['price']; ?></span>
                                                </p>
                                                <p><span class="availability"><?php echo $rowSearchResult['status']; ?></span></p>
                                                <p>
                                                    <span class="mileage"><?php echo $rowSearchResult['mileage']; ?> km</span>&nbsp;|&nbsp;
                                                    <span class="transmission"><?php echo $rowSearchResult['transmission']; ?></span>&nbsp;|&nbsp;
                                                    <span class="drivetrain"><?php echo $rowSearchResult['drivetrain']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php   } ?>
                <?php } ?>

                </tbody>
            </table>

        </div>


        <?php include 'template/payment-modal.php'; ?>

    </div>
    <?php include 'template/footer.php'; ?>
	
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/PaymentCalculator.js"></script>
<script>
    $(document).ready(function () {
       PaymentCalculator.init();
        $('#search-result-vehicle-table').DataTable({
            "pageLength": 1,
            "lengthChange": false,
            searching: false,
            "ordering": false
        });
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