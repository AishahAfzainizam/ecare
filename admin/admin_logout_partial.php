<?php
    session_start();
    unset($_SESSION['ad_email']);
    session_destroy();

    header("Location: admin_logout.php");
    exit;
?>