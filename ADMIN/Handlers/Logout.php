<?php
    session_start();

    require_once('UpdateStatus.php');

    Update('INACTIVE');

    if(session_destroy()){
        header("Location: ../login.php");
    }
?>