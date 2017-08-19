<?php
session_start();
require_once '../Db.php';
require_once 'server/AdminQuery.php';

if(isset($_SESSION['authenticated'])) {
	header('Location: dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = null;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = new AdminQuery();

    $msgTaken = null;
    if($q->isUsernameTaken($username) == "true") {
        $msgTaken = 'This username is already taken.';
    } else {
        if(!empty($username) && !empty($email) && !empty($password)) {
            if($q->insertAdmin($username, $email, $password)) {
                $result = 'You are one of the admin now!';
            } else {
                $result = 'There must be an error. Please try again later.';
            }
        }
    }


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

    <div class="template-page-wrapper splash2">
       
		
		<?php if(!empty($result)) { ?>
		<div class="templatemo-signin-form">
			<div class="col-md-12">
				<div class="col-sm-2"></div>
				<div class="col-sm-8" style="width: 100%;">
					<div class="alert alert-success text-center">Success!</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<?php } ?>

        <?php if(!empty($msgTaken)) { ?>
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
        <!--<form action="./model/forms/register.php" method="post" name="register-form" id="register-form" class="form-horizontal templatemo-signin-form" role="form" >-->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/common/util.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/common-html.js"></script>
<script src="js/validate.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>