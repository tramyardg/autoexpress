<?php ob_start(); session_start();
require_once 'server/AdminDAO.php';
require_once 'server/class/Admin.php';
require_once 'server/CarDAO.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    if(isset($_REQUEST['username'])) {
        $q->redirectNotFoundAdmin($_REQUEST['username']);
    }
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);
    $c = new CarDAO();


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
                <ol class="breadcrumb"><li class="active"><a href="#">Admin Panel</a></li></ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_data[0]->getUsername(); ?>">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $q->countAllAdmin(); ?></div>
                                        <div>Administrators</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-car fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $c->countAllCars(); ?></div>
                                        <div>Vehicles</div>
                                    </div>
                                </div>
                            </div>
                            <a href="inventory.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="margin-bottom-30">

                </div>


            </div>
        </div>



    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>