<?php
    require('../../../Handlers/DBCONNECT.php');
    session_start();

    $sql = "SELECT ID, TYPE FROM data_types";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['TYPE'] = $row['TYPE'];
            $i++;
        }

        echo json_encode($json);
    }
?>