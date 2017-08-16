<?php
session_start();
require_once 'server/AdminQuery.php';
require_once 'server/class/Admin2.php';

if(!isset($_SESSION['authenticated'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminQuery();
    if (!empty($_REQUEST['username'])){
        $usernameStr = $_REQUEST['username'];
        $q->redirectNotFound($usernameStr);
    }

    // Reuse existing query
    $results = $q->selectAllAdminInfo($_SESSION['adminUsername']);

    // check for results
    if (!$results) {
        return $results;
    } else {
        $admin_obj = array();
        foreach ($results as $result) {
            $admin_obj[] = new Admin2($result);
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

    <div class="template-page-wrapper">
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="#">Admin Panel</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Overview</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_obj[0]->getUsername(); ?>">
                <h1>Dashboard</h1>

                <div class="margin-bottom-30">

                </div>


            </div>
        </div>



    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/util.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>