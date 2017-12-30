<?php
    require ('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $ORDER_ID = $_GET['id'];

    $json = Array();
    $sql = "SELECT DISTINCT O.ID, O.SHIP_DATE_TIME, O.UNIQUE_ID, CONCAT(P.FIRST_NAME,' ',P.LAST_NAME) AS PERSON,
            OS.STATUS, O.ORDER_DATE_TIME, PY.TYPE, O.TOTAL
            FROM orders O 
            INNER JOIN persons P ON O.PERSON_ID = P.ID
            INNER JOIN payment_types PY ON O.PAYMENT_TYPE_ID = PY.ID
            INNER JOIN order_status OS ON O.ORDER_STATUS_ID = OS.ID
            WHERE O.ID = ".$ORDER_ID;
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
        while ($row = mysqli_fetch_array($result)){
            $json['ID'] = $row['ID'];
            $json['UNIQUE_ID'] = $row['UNIQUE_ID'];
            $json['PERSON'] = $row['PERSON'];
            $json['ORDER_DATE_TIME'] = $row['ORDER_DATE_TIME'];
            $json['SHIP_DATE_TIME'] = $row['SHIP_DATE_TIME'];
            $json['PAYMENT_TYPE'] = $row['TYPE'];
            $json['STATUS'] = $row['STATUS'];
            $json['TOTAL'] = $row['TOTAL'];

            $json['DETAILS'] = Array();
            $i = 0;
            $sql = "SELECT * FROM order_products_history WHERE ORDER_ID = ".$ORDER_ID;
            $res = mysqli_query($con,$sql);
            while($row2 = mysqli_fetch_array($res)){
                $json['DETAILS'][$i]['IMAGE_PATH'] = $row2['IMAGE_PATH'];
                $json['DETAILS'][$i]['DATA'] = $row2['DATA'];
                $i++;
            }
        }
    }
    echo json_encode($json);
?>