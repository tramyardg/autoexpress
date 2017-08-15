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
        <!--/.navbar-collapse -->

        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Manage Admins</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php if (isset($_SESSION['adminUsername'])) {echo $_SESSION['adminUsername'];} ?>">
                <h1>Manage Administrators</h1>

                <div class="row margin-bottom-30">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#">Admins total <span class="badge">4</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Privilege(s)</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>grandmaster</td>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" value="asddsassdasdds" readonly>
                                    </td>
                                    <td>leo@gmail.com</td>
                                    <td><a href="#" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Add vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Update
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Delete
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Manage other admins</label>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-link">Delete</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>leo</td>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" value="leoleo" readonly>
                                    </td>
                                    <td>rdg514@gmail.com</td>
                                    <td><a href="#" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Add vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Update
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Delete
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Manage other admins</label>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-link">Delete</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>editor</td>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" value="kevinlove" readonly>
                                    </td>
                                    <td>editor@hotmail.com</td>
                                    <td><a href="#" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Add vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Update
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Delete
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Manage other admins</label>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-link">Delete</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>deletor</td>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" value="kevinlove" readonly>
                                    </td>
                                    <td>deletor@hotmail.com</td>
                                    <td><a href="#" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Add vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Update
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Delete
                                                vehicles</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Manage other admins</label>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-link">Delete</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

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