<?php
session_start();
require_once 'server/AdminQuery.php';
require_once 'server/class/Admin2.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminQuery();
    if(isset($_REQUEST['username'])) {
        $q->redirectNotFoundAdmin($_REQUEST['username']);
    }
    $admin_data = $q->adminData_byUsername($_SESSION['adminUsername']);

    $all_admin = $q->allAdminData();


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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

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
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_data[0]->getUsername(); ?>">
                <h1>Manage Administrators</h1>

                <div class="row margin-bottom-30">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#">Admins total <span class="badge"><?php echo count($all_admin); ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="admin-table">
                                <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Privilege(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0; $i < count($all_admin); $i++) {
                                        $privilege_array = explode(',', $all_admin[$i]->getPrivilege());
                                    ?>
                                <tr>
                                    <td><?php echo $all_admin[$i]->getAdminId();  ?></td>
                                    <td><?php echo $all_admin[$i]->getUsername();  ?></td>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" value="<?php echo $all_admin[$i]->getPassword();  ?>" readonly>
                                    </td>
                                    <td><?php echo $all_admin[$i]->getEmail();  ?></td>
                                    <td>
                                        <?php if (in_array("1", $privilege_array)) { ?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Add vehicles</label>
                                        </div>
                                        <?php } ?>
                                        <?php if (in_array("2", $privilege_array)) { ?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Update
                                                vehicles</label>
                                        </div>
                                        <?php } ?>
                                        <?php if (in_array("3", $privilege_array)) { ?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Delete
                                                vehicles</label>
                                        </div>
                                        <?php } ?>
                                        <?php if (in_array("4", $privilege_array)) { ?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" checked disabled>Manage other admins</label>
                                        </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
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
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/util.js"></script>
<script src="js/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>