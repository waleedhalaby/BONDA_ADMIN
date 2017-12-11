<?php
    require ('../Handlers/DBCONNECT.php');
    require ('../Handlers/Authenticate.php');

    require ('../Handlers/Handler.php');
    $PERSON_ID = $_GET['id'];

    $sql = "SELECT P.FIRST_NAME, P.LAST_NAME, PM.* FROM person_messages PM
            INNER JOIN persons P ON PM.FROM_PERSON_ID = P.ID 
            WHERE TO_PERSON_ID = '".$PERSON_ID."' AND IS_SEEN = '0' 
            ORDER BY MESSAGE_DATE_TIME DESC LIMIT 5";
    $result = mysqli_query($con,$sql);
    $json = Array();
    if(mysqli_num_rows($result) > 0){
        $i = 0;
        while ($row = mysqli_fetch_array($result)){
            $time = strtotime($row['MESSAGE_DATE_TIME']);
            $myFormatForView = date("d-m-y h:i A", $time);
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['MESSAGE_DATE_TIME'] = GetDateFormat($myFormatForView);
            $json[$i]['FROM_PERSON'] = $row['FIRST_NAME'].' '.$row['LAST_NAME'];
            $json[$i]['TITLE'] = $row['TITLE'];
            $json[$i]['DESCRIPTION'] = $row['DESCRIPTION'];
            $i++;
        }
    }
    echo json_encode($json);
?>