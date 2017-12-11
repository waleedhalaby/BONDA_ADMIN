<?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $sql = "SELECT ID, TYPE, IS_ACTIVE FROM person_types PC WHERE ID <> 2";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['ROLE'] = $row['TYPE'];
            $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
            $sql = "SELECT COUNT(ID) FROM persons WHERE PERSON_TYPE_ID = ".$row['ID'];
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0){
                $json[$i]['MEMBERS'] = mysqli_fetch_array($result2)[0];
            }
            else{
                $json[$i]['MEMBERS'] = 0;
            }
            $i++;
        }

        echo json_encode($json);
    }
?>