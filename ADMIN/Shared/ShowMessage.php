<?php
require ('../Handlers/DBCONNECT.php');
require ('../Handlers/Handler.php');
    $MESSAGE_ID = $_GET['id'];

    $sql = "SELECT PF.FIRST_NAME AS PF_FIRST_NAME, PF.LAST_NAME AS PF_LAST_NAME, PF.EMAIL,PT.FIRST_NAME AS PT_FIRST_NAME, PT.LAST_NAME AS PT_LAST_NAME, PM.* FROM person_messages PM
            INNER JOIN persons PF ON PM.FROM_PERSON_ID = PF.ID
            INNER JOIN persons PT ON PM.TO_PERSON_ID = PT.ID
            WHERE PM.ID = '".$MESSAGE_ID."'";
    $result = mysqli_query($con,$sql);
    $json = Array();
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)){
            $time = strtotime($row['MESSAGE_DATE_TIME']);
            $myFormatForView = date("d-m-y h:i A", $time);
            $json['ID'] = $row['ID'];
            $json['MESSAGE_DATE_TIME'] = GetDateFormat($myFormatForView);
            $json['FROM_PERSON'] = $row['PF_FIRST_NAME'].' '.$row['PF_LAST_NAME'];
            $json['FROM_EMAIL'] = $row['EMAIL'];
            $json['TO_PERSON'] = $row['PT_FIRST_NAME'].' '.$row['PT_LAST_NAME'];
            $json['TITLE'] = $row['TITLE'];
            $json['DESCRIPTION'] = $row['DESCRIPTION'];
        }
    }
    echo json_encode($json);
?>