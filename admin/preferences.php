<?php
session_start();
if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Dashboard Preferences, Free Admin Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open%20Sans:300,400,700">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
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

        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="sign-in.php" class="btn btn-primary">Yes</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/util.js"></script>
<script src="js/commonhtml.js"></script>
<script src="js/app.js"></script>

</body>
</html>