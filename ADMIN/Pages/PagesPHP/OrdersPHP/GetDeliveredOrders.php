<?php
    require ('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $json = Array();
    $sql = "SELECT DISTINCT O.ID, O.UNIQUE_ID, CONCAT(P.FIRST_NAME,' ',P.LAST_NAME) AS PERSON, O.ORDER_DATE_TIME, PY.TYPE, O.TOTAL
            FROM orders O 
            INNER JOIN persons P ON O.PERSON_ID = P.ID
            INNER JOIN payment_types PY ON O.PAYMENT_TYPE_ID = PY.ID
            WHERE ORDER_STATUS_ID = 4";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
        $i = 0;
        while ($row = mysqli_fetch_array($result)){
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['UNIQUE_ID'] = $row['UNIQUE_ID'];
            $json[$i]['PERSON'] = $row['PERSON'];
            $json[$i]['ORDER_DATE_TIME'] = $row['ORDER_DATE_TIME'];
            $json[$i]['PAYMENT_TYPE'] = $row['TYPE'];
            $json[$i]['TOTAL'] = $row['TOTAL'];
            $i++;
        }
    }
    echo json_encode($json);
?>