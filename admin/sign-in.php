<?php
session_start();
require_once 'model/Query.php';
require_once 'model/entity/Admin.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $exists = null;
    $q = new Query();
    $username = $q->stringValue($_POST['username']);
    $password = $q->stringValue($_POST['password']);

    $new_admin = new Admin($username, $password);

    $q = new Query();
    // returns true if admin exists, otherwise return false
    $exists = !empty($q->selectIfAdminExists($new_admin)) ? $exists = true : $exists = false;

    if($exists == 1) {
        $_SESSION['authenticated'] = 1;
    }

}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<!--    <title>Dashboard Sign In, Free Admin Template</title>-->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
</head>
<body>
<div id="main-wrapper">


    <div class="template-page-wrapper splash"  >
        <?php if(isset($exists) && $exists != 1) { ?>
        <div class="templatemo-signin-form">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="width: 100%;">
                    <div class="alert alert-warning text-center">
                        <?php echo 'There is no admin with this username.'; ?>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php } else if(isset($exists) && $exists == 1) { ?>
        <div class="templatemo-signin-form">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="width: 100%;">
                    <div class="alert alert-info text-center">
                        <?php echo 'Loading, please wait.';
                        header( "refresh:1; url=dashboard.php" );
                        ?>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php } ?>

        <form action="" class="form-horizontal templatemo-signin-form" role="form" onsubmit="return LoginValidate.validateForm();" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Sign in" class="btn btn-default">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/util.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/commonhtml.js"></script>
<script src="js/validate.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>