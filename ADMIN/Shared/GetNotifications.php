<?php
    require ('../Handlers/DBCONNECT.php');
    require ('../Handlers/Handler.php');
    $PERSON_ID = $_GET['id'];

    $sql = "SELECT * FROM notifications WHERE IS_SEEN = '0' AND NOTIFY_DATE_TIME > DATE_SUB(NOW(), INTERVAL  5 DAY) LIMIT 5";
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
?>