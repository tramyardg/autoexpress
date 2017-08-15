<?php
session_start();
require_once 'server/Utility.php';
require_once 'server/AdminQuery.php';
require_once 'server/entity/Admin.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $util = new Utility();
    $usernameStr = $util->stringValue($_REQUEST['username']);

    $q = new AdminQuery();
    $q->redirectNotAdmin($usernameStr);
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.min.css">

</head>
<body>
<div id="main-wrapper">

    <div class="template-page-wrapper">

        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Preferences</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php if (isset($_SESSION['adminUsername'])) {echo $_SESSION['adminUsername'];} ?>">
                <h1>Preferences</h1>
                <p class="margin-bottom-15">Here goes another form and form controls.</p>
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" id="templatemo-preferences-form">
                            <div class="row">
                                <div class="col-md-6 margin-bottom-15">
                                    <label for="firstName" class="control-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" value="John">
                                </div>
                                <div class="col-md-6 margin-bottom-15">
                                    <label for="lastName" class="control-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" value="Henry">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 margin-bottom-15">
                                    <label>Username</label>
                                    <p class="form-control-static" id="username">@admin</p>
                                </div>
                                <div class="col-md-6 margin-bottom-15">
                                    <label>Email address</label>
                                    <p class="form-control-static" id="email">admin@company.com</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 margin-bottom-15">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword" value="********"
                                           disabled="">
                                </div>
                                <div class="col-md-6 margin-bottom-15">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 margin-bottom-15">
                                    <label for="password_1">New Password</label>
                                    <input type="password" class="form-control" id="password_1"
                                           placeholder="New Password">
                                </div>
                                <div class="col-md-6 margin-bottom-15">
                                    <label for="password_2">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_2"
                                           placeholder="Confirm New Password">
                                </div>
                            </div>


                            <div class="row templatemo-form-buttons">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/util.js"></script>
<script src="js/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>