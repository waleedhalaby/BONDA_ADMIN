<?php
    require ('../Handlers/DBCONNECT.php');
    $NOTIFY_ID = $_GET['id'];

    $sql = "UPDATE notifications SET IS_SEEN = '1' WHERE ID = '".$NOTIFY_ID."'";
    $result = mysqli_query($con,$sql);
?>