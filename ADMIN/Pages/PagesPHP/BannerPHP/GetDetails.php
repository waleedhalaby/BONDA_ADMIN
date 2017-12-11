<?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $BANNER_ID = $_GET['id'];
    $sql = "SELECT ID, IMAGE_PATH, TITLE, DESCRIPTION FROM banner_images WHERE ID = ".$BANNER_ID;
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    $json = Array();
    if($rows > 0){
        while($row = mysqli_fetch_array($result)){
            $json['ID'] = $row['ID'];
            $json['IMAGE'] = $row['IMAGE_PATH'];
            $json['TITLE'] = $row['TITLE'];
            $json['DESCRIPTION'] = $row['DESCRIPTION'];
        }

        echo json_encode($json);
    }
?>