<?php
    require ('../../../Handlers/DBCONNECT.php');

    $sql = "DELETE FROM log_activities";
    $result = mysqli_query($con,$sql);
?>