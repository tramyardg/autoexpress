<?php
session_start();
require_once 'server/AdminDAO.php';
require_once 'server/CarDAO.php';
require_once 'server/class/Admin.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    if(isset($_REQUEST['username'])) {
        $q->redirectNotFoundAdmin($_REQUEST['username']);
    }
    $admin_data = $q->adminDataByUsername($_SESSION['adminUsername']);

    $v = new CarDAO();
    $num_cars = $v->countAllCars();
    $all_cars = $v->allCarsData();
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <style>
        .thumb {
            height: 75px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
        }
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

    <div class="template-page-wrapper">
        <!--/.navbar-collapse -->

        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Manage Inventory</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_data[0]->getUsername(); ?>">
                <h1>Manage Vehicles</h1>
                <p>Here goes vehicles from the inventory.</p>

                <div class="row margin-bottom-30">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#">Number of Vehicles <span class="badge"><?php echo $num_cars; ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <h4 class="margin-bottom-15">Vehicles table</h4>
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
                                <?php for($i = 0; $i < $num_cars; $i++) { ?>
                                <tr>
                                    <td><?php echo $all_cars[$i]->getYearMade(); ?></td>
                                    <td><?php echo $all_cars[$i]->getMake(); ?></td>
                                    <td><?php echo $all_cars[$i]->getModel(); ?></td>
                                    <td><?php echo $all_cars[$i]->getPrice(); ?></td>
                                    <td><?php echo $all_cars[$i]->getStatus(); ?></td>
                                    <td><?php echo $all_cars[$i]->getMileage(); ?></td>
                                    <td><?php echo $all_cars[$i]->getTransmission(); ?></td>
                                    <td><?php echo $all_cars[$i]->getDriveTrain(); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Update</a></li>
                                                <li><a href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Add new</button>

                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <form action="" method="post" name="add-car" id="add-car" onsubmit="" enctype="multipart/form-data">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">General vehicle info</div>
                                                <div class="panel-body">
                                                    <table cellspacing="1" id="car-general-info-table">
                                                        <tbody>
                                                        <tr>
                                                            <td>Make<span class="input-required"> *</span></td>
                                                            <td>
                                                                <select name="make" id="make" class="" onchange="">
                                                                    <option selected="selected" value="">Select Make</option>
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
                                                                    <option value="Fiat">Fiat</option>
                                                                    <option value="Ford">Ford</option>
                                                                    <option value="GMC">GMC</option>
                                                                    <option value="Honda">Honda</option>
                                                                    <option value="Hummer">Hummer</option>
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
                                                                    <option value="Mitsubishi">Mitsubishi</option>
                                                                    <option value="Nissan">Nissan</option>
                                                                    <option value="Pontiac">Pontiac</option>
                                                                    <option value="Porsche">Porsche</option>
                                                                    <option value="Saab">Saab</option>
                                                                    <option value="Saturn">Saturn</option>
                                                                    <option value="Scion">Scion</option>
                                                                    <option value="Subaru">Subaru</option>
                                                                    <option value="Suzuki">Suzuki</option>
                                                                    <option value="Tesla">Tesla</option>
                                                                    <option value="Toyota">Toyota</option>
                                                                    <option value="Unspecified">Unspecified</option>
                                                                    <option value="Volkswagen">Volkswagen</option>
                                                                    <option value="Volvo">Volvo</option>
                                                                </select>
                                                                <b style="font-size: 10px; color: red;" id="make-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Year<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="number" name="year" id="year" alt="year" title="year" />
                                                                <b style="font-size: 10px; color: red;" id="year-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="text" name="model" id="model" title="model" />
                                                                <b style="font-size: 10px; color: red;" id="model-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="number" name="price" id="price" title="price" />
                                                                <b style="font-size: 10px; color: red;" id="price-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mileage(Km)<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="number" name="mileage" id="mileage" title="mileage" />
                                                                <b style="font-size: 10px;  color: red;" id="mileage-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Transmission<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="radio" name="transmission" id="transmission" value="Automatic" title="transmission"> Automatic
                                                                <input type="radio" name="transmission" id="transmission" value="Manual" title="transmission"> Manual
                                                                <b style="font-size: 10px; color: red;" id="transmission-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Drivetrain<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="radio" name="drivetrain" id="drivetrain" value="AWD" title="drivetrain"> AWD
                                                                <input type="radio" name="drivetrain" id="drivetrain" value="FWD" title="drivetrain"> FWD
                                                                <input type="radio" name="drivetrain" id="drivetrain" value="RWD" title="drivetrain"> RWD
                                                                <input type="radio" name="drivetrain" id="drivetrain" value="4X4" title="drivetrain"> 4X4
                                                                <b style="font-size: 10px; color: red;" id="drivetrain-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <span class="input-required">*</span> <span class="label label-danger">Required fields</span>
                                                </div>
                                            </div>

                                            <div class="panel panel-primary">
                                                <div class="panel-heading">Category and photos (optional)</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Car</b> <br/>
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Subcompact car"> Subcompact car <br/>
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Compact car"> Compact car <br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size car"> Mid-size car <br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Entry-level luxury car"> Entry-level luxury car <br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size luxury car"> Mid-size luxury car <br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Full-size car"> Full-size car
                                                        </div>
                                                        <div class="col-md-5">
                                                            <b>Truck</b><br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Minivan"> Minivan<br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Van"> Van<br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Compact SUV"> Compact SUV<br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Mid-size SUV"> Mid-size SUV<br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Full-size SUV"> Full-size SUV<br />
                                                            <input class="right_side" type="radio" name="category" id="category" title="category" value="Pickup"> Pickup
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            Photo(s):
                                                            <input type="file" id="files" name="files[]" multiple />
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
                                                                                span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                                                                    '" title="', escape(theFile.name), '"/>'].join('');
                                                                                document.getElementById('list').insertBefore(span, null);
                                                                            };
                                                                        })(f);

                                                                        // Read in the image file as a data URL.
                                                                        reader.readAsDataURL(f);
                                                                    }
                                                                }

                                                                document.getElementById('files').addEventListener('change', handleFileSelect, false);
                                                            </script>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="panel panel-primary">
                                                <div class="panel-heading">Engine and chassis</div>
                                                <div class="panel-body">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td>Cylinder</td>
                                                            <td>
                                                                <input type="radio" name="cylinder" id="cylinder" title="cylinder" value="4"> 4
                                                                <input type="radio" name="cylinder" id="cylinder" title="cylinder" value="6"> V6
                                                                <input type="radio" name="cylinder" id="cylinder" title="cylinder" value="8"> V8
                                                                <input type="radio" name="cylinder" id="cylinder" title="cylinder" value="10"> V10
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Capacity (Litre) <span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="text" name="capacity" id="capacity">
                                                                <b style="font-size: 10px; color: red;" id="capacity-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Doors<span class="input-required"> *</span></td>
                                                            <td>
                                                                <input type="text" name="doors" id="doors">
                                                                <b style="font-size: 10px; color: red;" id="door-err">&nbsp;</b>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <span class="input-required">*</span> <span class="label label-danger">Required fields</span>
                                                </div>
                                            </div>

                                            <div class="panel panel-success">
                                                <div class="panel-heading">Submit form</div>
                                                <div class="panel-body">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                                <input type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close" value="Cancel"></input>
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
                </div>



            </div>

        </div>


    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/util.js"></script>
<script src="js/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>