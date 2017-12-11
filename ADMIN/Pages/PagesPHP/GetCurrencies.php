<?php
    require('../../Handlers/DBCONNECT.php');
    require ('../../Handlers/Authenticate.php');

    $sql = "SELECT ID, CURRENCY FROM currencies";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        $json = mysqli_fetch_all($result);

        echo json_encode($json);
    }
?>