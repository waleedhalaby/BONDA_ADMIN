<?php
    require('../../../Handlers/DBCONNECT.php');
    session_start();

    $sql = "SELECT ID, CATEGORY FROM product_categories WHERE IS_ACTIVE = 1";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        $json = mysqli_fetch_all($result);

        echo json_encode($json);
    }
?>