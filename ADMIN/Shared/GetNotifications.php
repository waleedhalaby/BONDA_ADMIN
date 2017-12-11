<?php
    require ('../Handlers/DBCONNECT.php');
    require ('../Handlers/Authenticate.php');

require ('../Handlers/Handler.php');
    $PERSON_ID = $_GET['id'];

    $sql = "SELECT * FROM notifications WHERE IS_SEEN = '0' ORDER BY NOTIFY_DATE_TIME DESC LIMIT 5";
    $result = mysqli_query($con,$sql);
    $json = Array();
    if(mysqli_num_rows($result) > 0){
        $i = 0;
        while ($row = mysqli_fetch_array($result)){
            $time = strtotime($row['NOTIFY_DATE_TIME']);
            $myFormatForView = date("d-m-y h:i A", $time);
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['ICON'] = $row['ICON'];
            $json[$i]['COLOR'] = $row['COLOR'];
            $json[$i]['NOTIFY_DATE_TIME'] = GetDateFormat($myFormatForView);
            $json[$i]['PAGE_URL'] = $row['PAGE_URL'];
            $json[$i]['DESCRIPTION'] = $row['DESCRIPTION'];
            $i++;
        }
    }
    echo json_encode($json);

//    $sql = "SELECT ID FROM privileges WHERE ID = 32 OR ID = 33 OR ID = 38 OR ID = 39 OR ID = 45 OR ID = 65 OR ID = 66";
//    $res = mysqli_query($con,$sql);
//    while($row = mysqli_fetch_array($res)){
//        mysqli_query($con,"INSERT INTO person_privileges (PERSON_ID,PRIVILEGE_ID,VALUE) VALUES ('111111','".$row['ID']."','0')");
//        echo $row['ID']." ";
//    }
?>