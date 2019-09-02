<?php
ob_start();
session_start();
require_once 'server/model/Dbh.php';
require_once 'server/AdminDAO.php';

if (isset($_SESSION['authenticated'])) {
    header('Location: dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = null;
    $condition = 0;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = new AdminDAO();

    $msgTaken = null;
    if (count($q->getAdminByUsername($username)) > 0) {
        $msgTaken = 'This username is already taken.';
    } else {
        if (!empty($username) && !empty($email) && !empty($password)) {
            if ($q->create($username, $email, $password)) {
                $cond = 1;
            }
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.min.css">

</head>
<body>
<div id="main-wrapper">

    <div class="template-page-wrapper splash2">


        <?php if (isset($cond) && $cond === 1) { ?>
		<div class="templatemo-signin-form">
			<div class="col-md-12">
				<div class="col-sm-2"></div>
				<div class="col-sm-8" style="width: 100%;">
					<div class="alert alert-success text-center">Success! <?php echo 'Redirecting to login page, please wait.';?></div>
                    <?php header( "refresh:4; url=sign-in.php"); ?>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<?php } ?>

        <?php if (!empty($msgTaken)) { ?>
            <div class="templatemo-signin-form">
                <div class="col-md-12">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8" style="width: 100%;">
                        <div class="alert alert-warning text-center"><?php echo $msgTaken; ?></div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        <?php } ?>
		
        <form action="" method="post" onsubmit="return RegisterValidate.validateForm();" name="register-form" id="register-form" class="form-horizontal templatemo-signin-form" role="form" >
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
                    <label for="password" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@domain.com">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" minlength="5" maxlength="10" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" minlength="5" maxlength="10" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Register" name="register-submit" class="btn btn-default">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/validation/register-validate.js"></script>
<script src="js/app.js"></script>

</body>
</html>