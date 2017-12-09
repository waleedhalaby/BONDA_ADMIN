<?php
    require('../../../Handlers/DBCONNECT.php');
    session_start();
    $DESIGNER_ID = $_GET['id'];
    $sql = "SELECT ID, NAME, IS_ACTIVE, DESCRIPTION FROM designers WHERE ID = '".$DESIGNER_ID."'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['NAME'] = $row['NAME'];
            $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
            $json[$i]['DESCRIPTION'] = $row['DESCRIPTION'];
            $sql = "SELECT COUNT(PRODUCT_ID) FROM designer_products WHERE DESIGNER_ID = '".$row['ID']."'";
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0){
                $json[$i]['PRODUCTS'] = mysqli_fetch_array($result2)[0];
            }
            else{
                $json[$i]['PRODUCTS'] = 0;
            }
            $i++;
        }

        echo json_encode($json);
    }
?>