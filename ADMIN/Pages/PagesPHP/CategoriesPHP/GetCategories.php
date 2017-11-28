<?php
    require('../../../Handlers/DBCONNECT.php');
    session_start();

    $sql = "SELECT ID, CATEGORY, IS_ACTIVE FROM product_categories PC";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['CATEGORY'] = $row['CATEGORY'];
            $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
            $sql = "SELECT COUNT(ID) FROM products WHERE CATEGORY_ID = ".$row['ID'];
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