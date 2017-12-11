<?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $sql = "SELECT ID, IMAGE_PATH, DESIGNER, IS_ACTIVE, DESCRIPTION FROM designers PC";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['IMAGE'] = $row['IMAGE_PATH'];
            $json[$i]['DESIGNER'] = $row['DESIGNER'];
            $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
            $json[$i]['DESCRIPTION'] = $row['DESCRIPTION'];
            $sql = "SELECT COUNT(ID) FROM categories WHERE DESIGNER_ID = '".$row['ID']."'";
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0){
                $json[$i]['CATEGORIES'] = mysqli_fetch_array($result2)[0];
            }
            else{
                $json[$i]['CATEGORIES'] = 0;
            }
            $i++;
        }

        echo json_encode($json);
    }
?>