<?php
    session_start();

    require_once('UpdateStatus.php');

    Update('INACTIVE');
    ResetPages();
    session_destroy();
    header("Location: ../login.php");
?>