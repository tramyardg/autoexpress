<?php
ob_start();
session_start();
require_once 'server/model/Enum.php';
require_once 'server/model/AdminLevel.php';
require_once 'server/AdminDAO.php';
require_once 'server/model/Admin.php';

if (!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);
    $adminLevel = $admin_data[0]->getAdminLevel();
    $levelArray = AdminLevel::splitAdminLevelArray(intval($adminLevel));
    $all_admin = $q->getAllAdmin();
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
    <title>AutoExpress.co.nf - Raymart De Guzman</title>
    <meta name="title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta name="description" content="Autoexpress.co.nf is a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta name="keywords" content="Raymart De Guzman, tramyardg.co.nf, tramyardg, PHP, car dealership, software engineer, car dealer, car buyer, AutoExpress.co.nf">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://autoexpress.co.nf"/>
    <meta property="og:title" content="AutoExpress.co.nf - Raymart De Guzman">
    <meta property="og:description" content="Autoexpress.co.nf is a car dealership app built for both car dealer and car buyer. A car dealer manages the car being viewed on the website by adding, updating, deleting and uploading photos of a car. On the other hand, a car buyer can search for the vehicle he or she desired on the website. If the buyer finds the desired vehicle he or she can contact the seller to get more information of the vehicle. A car buyer can also calculate their monthly or bi-weekly payment.">
    <meta property="og:image" content="https://raw.githubusercontent.com/tramyardg/autoexpress/master/image/homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.min.css">
	<link rel="stylesheet" href="css/datatables.min.css">

</head>
<body>
<div id="main-wrapper">
    <div class="template-page-wrapper">
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Manage Admins</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php  echo $admin_data[0]->getUsername(); ?>">
                <h1>Admin Level</h1>
                <code>TO DO</code>
                <div class="row margin-bottom-30">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>