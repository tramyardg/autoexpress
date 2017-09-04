<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';

$v = new CarDAO();
$all_cars = $v->getAllCars();
$num_cars = $v->countAllCars();

$d = new DiagramDAO();

$search = filter_input(INPUT_GET, 'search-car');
if(!empty($search)) {
    $searchMake = filter_input(INPUT_GET, 'searchMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $searchModel = filter_input(INPUT_GET, 'searchModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $minYear = filter_input(INPUT_GET, 'minYear', FILTER_VALIDATE_INT);
    $maxYear = filter_input(INPUT_GET, 'maxYear', FILTER_VALIDATE_INT);
    $minPrice = filter_input(INPUT_GET, 'minPrice', FILTER_VALIDATE_INT);
    $maxPrice = filter_input(INPUT_GET, 'maxPrice', FILTER_VALIDATE_INT);
    $minMileage = filter_input(INPUT_GET, 'minMileage', FILTER_VALIDATE_INT);
    $maxMileage = filter_input(INPUT_GET, 'maxMileage', FILTER_VALIDATE_INT);

    $searchArray = array(
        "searchMake" => $searchMake,
        "searchModel" => $searchModel,
        "minYear" =>$minYear,
        "maxYear" => $maxYear,
        "minPrice" => $minPrice,
        "maxPrice" => $maxPrice,
        "minMileage" => $minMileage,
        "maxMileage" => $maxMileage
    );

    if(empty($searchArray["minPrice"])) {
        $searchArray["minPrice"] = 0;
    }
    if(empty($searchArray["maxPrice"])) {
        $searchArray["maxPrice"] = 999999;
    }
    if(empty($searchArray["minMileage"])) {
        $searchArray["minMileage"] = 0;
    }
    if(empty($searchArray["maxMileage"])) {
        $searchArray["maxMileage"] = 999999;
    }
    $searchCarResult = $v->getSearchResult($searchArray);
    $searchResultLength = count($searchCarResult);
}

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
    <div class="header">
        <div>Your <span class="orange-logo-text">Logo</span> Here</div>
        <div class="clear-both"></div>
        <div class="menu-header">
            <div id="menu-header-left-section">
                <span><a href="#"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a></span>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>

    <div class="sidebar1">
        <div class="search-menu">
            <form method="get" action="">
                <ul>
                    <li><label><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Advance Search</label></li>
                    <li>Make</li>
                    <li>
                        <select title="searchMake" name="searchMake" id="searchMake" class="" onchange="selectCarMakeFn(this);">
                            <option selected value="%">Select all</option>
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
                    </li>
                    <li>
                        <select name="searchModel" id="searchModel" title="searchModel" required>
                            <option selected value="%">Select model</option>
                        </select>
                    </li>
                    <li>Year: min</li>
                    <li>
                        <select title="minYear" name="minYear">
                            <option value="1990">Select year&nbsp;</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                        </select>
                    </li>
                    <li>Year: max</li>
                    <li>
                        <select title="maxYear" name="maxYear">
                            <option value="2019">Select year</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                        </select>
                    </li>
                    <li>Price:</li>
                    <li><input type="number" max="999999" min="0" name="minPrice" placeholder="from"></li>
                    <li><input type="number" max="999999" min="0" name="maxPrice" placeholder="to"></li>
                    <li>Mileage:</li>
                    <li><input type="number" max="999999" min="0" name="minMileage" placeholder="from"></li>
                    <li><input type="number" max="999999" min="0" name="maxMileage" placeholder="to"></li>
                    <li><input type="submit" name="search-car" value="Search"></li>
                </ul>
            </form>
        </div>
    </div>
    
	<div class="content">
        <div class="content-car-section">
            <?php ?>

            <table id="inventory-vehicle-table">
                <thead>
                    <tr>
                        <th>
                            &nbsp;
                            <?php
                            if(!empty($searchCarResult)) {
                                $vehicleTxt = ($searchResultLength > 1) ? $vehicleTxt = ' vehicles' : $vehicleTxt = ' vehicle';
                                echo '<p style="padding: 0;">'.$searchResultLength . ''.$vehicleTxt.' found.</p>';
                            }
                            ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($searchCarResult)) { ?>
                <?php   for($i = 0; $i < $num_cars; $i++) { ?>
                        <tr>
                            <td>
                                <div class="divTable" id="car-item-<?php echo $i; ?>">
                                    <div class="divTableBody">
                                        <div class="divTableRow">
                                            <div class="divTableCell">
                                                <div class="row car-images" >
                                                    <?php
                                                    // first if stmt: use placeholdit as image if this car has no images
                                                    // second if stmt: no badge for car that has no images
                                                    $currCarImg = $d->getPhotosBy_CarId($all_cars[$i]->getVehicleId());
                                                    if($d->countAllPhotosByCarId($all_cars[$i]->getVehicleId()) == "0") {
                                                        $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                    } else {
                                                        $h = $currCarImg[0]->getDiagram();
                                                    }
                                                    ?>
                                                    <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>">
                                                    <?php if($d->countAllPhotosByCarId($all_cars[$i]->getVehicleId()) != "0") { ?>
                                                        <span class="badge"><?php echo $d->countAllPhotosByCarId($all_cars[$i]->getVehicleId()); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="feature_links">
                                                    <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                       data-target="#calculatePaymentModal" data-price="<?php echo $all_cars[$i]->getPrice(); ?>" >
                                                        <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                                                    </a>
                                                    <a href="<?php echo 'details.php?carId='.$all_cars[$i]->getVehicleId(); ?>" title="View more details">
                                                        <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="car_info">
                                                    <p>
                                                        <span class="car-title"><?php echo $all_cars[$i]->getHeadingTitle(); ?> - </span>
                                                        <span class="price-style">$<?php echo $all_cars[$i]->getPrice(); ?></span>
                                                    </p>
                                                    <p><span class="availability"><?php echo $all_cars[$i]->getStatus(); ?></span></p>
                                                    <p>
                                                        <span class="mileage"><?php echo $all_cars[$i]->getMileage(); ?> km</span>&nbsp;|&nbsp;
                                                        <span class="transmission"><?php echo $all_cars[$i]->getTransmission(); ?></span>&nbsp;|&nbsp;
                                                        <span class="drivetrain"><?php echo $all_cars[$i]->getDrivetrain(); ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php   } ?>
                <?php } else { ?>
                <?php   for($i = 0; $i < $searchResultLength; $i++) { ?>
                        <tr>
                            <td>
                                <div class="divTable" id="car-item-<?php echo $i; ?>">
                                    <div class="divTableBody">
                                        <div class="divTableRow">
                                            <div class="divTableCell">
                                                <div class="row car-images" >
                                                    <?php
                                                    // first if stmt: use placeholdit as image if this car has no images
                                                    // second if stmt: no badge for car that has no images
                                                    $currCarImg = $d->getPhotosBy_CarId($searchCarResult[$i]->getVehicleId());
                                                    if($d->countAllPhotosByCarId($searchCarResult[$i]->getVehicleId()) == "0") {
                                                        $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                    } else {
                                                        $h = $currCarImg[0]->getDiagram();
                                                    }
                                                    ?>
                                                    <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>">
                                                    <?php if($d->countAllPhotosByCarId($searchCarResult[$i]->getVehicleId()) != "0") { ?>
                                                        <span class="badge"><?php echo $d->countAllPhotosByCarId($searchCarResult[$i]->getVehicleId()); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="feature_links">
                                                    <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                       data-target="#calculatePaymentModal" data-price="<?php echo $searchCarResult[$i]->getPrice(); ?>" >
                                                        <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                                                    </a>
                                                    <a href="<?php echo 'details.php?carId='.$searchCarResult[$i]->getVehicleId(); ?>" title="View more details">
                                                        <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="divTableCell">
                                                <div class="car_info">
                                                    <p>
                                                        <span class="car-title"><?php echo $searchCarResult[$i]->getHeadingTitle(); ?> - </span>
                                                        <span class="price-style">$<?php echo $searchCarResult[$i]->getPrice(); ?></span>
                                                    </p>
                                                    <p><span class="availability"><?php echo $searchCarResult[$i]->getStatus(); ?></span></p>
                                                    <p>
                                                        <span class="mileage"><?php echo $searchCarResult[$i]->getMileage(); ?> km</span>&nbsp;|&nbsp;
                                                        <span class="transmission"><?php echo $searchCarResult[$i]->getTransmission(); ?></span>&nbsp;|&nbsp;
                                                        <span class="drivetrain"><?php echo $searchCarResult[$i]->getDrivetrain(); ?></span>
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

        <!-- share modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="shareLinkModal" aria-labelledby="shareLinkModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Copy the URL below to share</h4>
                    </div>
                    <div class="modal-body">
                        <label>Paste this link in email or IM</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- payment calculator modal -->
        <div class="modal fade" id="calculatePaymentModal" tabindex="-1"  role="dialog" aria-labelledby="calculatePaymentModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Estimate your monthly or bi-weekly payment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="calculateTbl">
                                    <tbody>
                                    <tr>
                                        <td>Vehicle price</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input title="Car price" readonly type="text" class="modal-car-price" name="modal-car-price" value=""></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Trade</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="0" title="Trade" type="text" class="modal-trade" name="modal-trade" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Down payment</td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="0" title="Down payment" type="text" class="modal-down-payment" name="modal-down-payment" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Term by months</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <select title="Term" class="modal-term" name="modal-term" onchange="">
                                                <option value="12">12 months</option>
                                                <option value="24">24 months</option>
                                                <option value="36">36 months</option>
                                                <option value="48">48 months</option>
                                                <option selected="selected" value="60">60 months</option>
                                                <option value="72">72 months</option>
                                                <option value="84">84 months</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Interest rate</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input value="5.99" placeholder="%" title="Interest rate" type="text" class="modal-int-rate" name="modal-int-rate" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Sales tax</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input placeholder="%" title="Sales tax" type="text" class="modal-sales-tax" name="modal-sales-tax" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input type="button" class="modal-calculate-btn" name="modal-calculate-btn" value="Calculate"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Monthly payments</td>
                                        <td>&nbsp;</td>
                                        <td>$</td>
                                        <td>&nbsp;<span class="modal-monthly-payment"></span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Bi-Weekly</td>
                                        <td>&nbsp;</td>
                                        <td>$</td>
                                        <td>&nbsp;<span class="modal-bi-weekly"></span></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <p id="payment-value-notice">Note: This payment calculator uses loan amortization formula and inputs are based on the information you entered. Payment does not include other fees.</p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    
	<div class="footer">
        <div id="footer-content">
            <p>Copyright © 2014-2017 | Raymart De Guzman | Leo Sudarma</p>
        </div>
    </div>
	
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/PaymentCalculator.js"></script>
<script>
    $(document).ready(function () {
       PaymentCalculator.init();
        $('#inventory-vehicle-table').DataTable({
            "pageLength": 3,
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