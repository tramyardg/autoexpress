<?php ob_start(); session_start();

require_once 'server/AdminDAO.php';
require_once 'server/model/Utility.php';
require_once 'server/model/Admin.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST['password_1']) && !empty($_POST['password_2'])) {

            $q = new AdminDAO();
            $save = new Admin(
                $_POST["admin-id"],
                $_POST["username"],
                $_POST["password_1"],
                $_POST["email"],
                $q->getTimeStamp()
            );
            $q->update($save);
            header("Location: preferences.php?username=".$admin_data[0]->getUsername().'&updated=true');
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <!-- Primary Meta Tags -->
    <title>AutoExpress - Raymart De Guzman</title>
    <meta name="title" content="AutoExpress - Raymart De Guzman">
    <meta name="description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta name="keywords" content="Raymart De Guzman, tramyardg.co.nf, tramyardg, PHP, car dealership, software engineer, car dealer, car buyer, AutoExpress.co.nf">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta property="og:description" content="AutoExpress a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta property="og:image" content="https://raw.githubusercontent.com/tramyardg/autoexpress/master/image/homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
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
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_data[0]->getUsername(); ?>">
                <h1>Preferences</h1>
                <p class="margin-bottom-15">Update account information. Last updated <?php echo $admin_data[0]->getLastUpdate() . '.' ?></p>
                <?php if(isset($_REQUEST['updated']) && $_REQUEST['updated'] == 'true') { ?>
                    <div class="col-sm-12" style="width: 100%; padding: 0;">
                        <div class="alert alert-success text-center">
                            <?php echo'1 records UPDATED successfully'; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" role="form" id="templatemo-preferences-form" onsubmit="return PasswordMatchValidate.validateForm();" method="post">
                            <div class="row">
                                <div class="form-group hidden">
                                    <input type="text" class="hidden" id="username" name="username" value="<?php echo $admin_data[0]->getUsername(); ?>">
                                </div>

                                <div class="form-group hidden">
                                    <input type="number" readonly id="admin-id" name="admin-id" value="<?php echo $admin_data[0]->getAdminId(); ?>">
                                </div>

                                <div class="form-group hidden">
                                    <input type="text" readonly id="last-updated" name="last-updated" value="<?php echo $admin_data[0]->getLastUpdate(); ?>">
                                </div>

                                <div class="form-group hidden">
                                    <input type="text" readonly id="email" name="email" value="<?php echo $admin_data[0]->getEmail(); ?>">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4>Username</h4>
                                        <p class="form-control-static"><?php echo $admin_data[0]->getUsername(); ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4>Email address</h4>
                                        <p class="form-control-static"><?php echo $admin_data[0]->getEmail(); ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="currentPassword">Current Password</h4>
                                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                               value="<?php echo $admin_data[0]->getPassword(); ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="password_1">New Password</h4>
                                        <input type="password" class="form-control" id="password_1" name="password_1"
                                               placeholder="New Password" maxlength="10" minlength="5">
                                        <label class="util-msg"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="password_2">Confirm New Password</h4>
                                        <input type="password" class="form-control" id="password_2" name="password_2"
                                               placeholder="Confirm New Password" maxlength="10" minlength="5">
                                        <label class="util-msg"></label>
                                    </div>
                                </div>
                            </div>



                            <div class="row templatemo-form-buttons">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/validation/preference-validate.js"></script>
<script src="js/app.js"></script>

</body>
</html>