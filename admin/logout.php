<?php session_start(); ?>

<html>
<body>
<p>Redirecting... Please wait.</p>
<?php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 1) {
    session_destroy();
    header('refresh: 3; url=sign-in.php');
} else {

}
?>
</body>
</html>