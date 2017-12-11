<?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $sql = "SELECT PC.ID, PC.FEATURE, DT.TYPE, PC.IS_ACTIVE FROM product_features PC
            INNER JOIN data_types DT ON PC.DATA_TYPE_ID = DT.ID";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['FEATURE'] = $row['FEATURE'];
            $json[$i]['DATA_TYPE'] = $row['TYPE'];
            $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
            $i++;
        }

        echo json_encode($json);
    }
?>