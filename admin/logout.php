<?php ob_start();
session_start(); ?>

<html lang="en">
<body>
<p>Signing out... Please wait.</p>
<?php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 1) {
    session_destroy();
    header('refresh: 1; url=sign-in.php');
}
?>
</body>
</html>