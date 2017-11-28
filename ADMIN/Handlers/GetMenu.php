<?php
    require ('DBCONNECT.php');

    $sql = 'SELECT * FROM pages';
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        $json = mysqli_fetch_all($result);

        echo json_encode($json);
    }
?>