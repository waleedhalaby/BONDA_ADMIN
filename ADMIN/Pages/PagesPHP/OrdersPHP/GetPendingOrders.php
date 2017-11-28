<?php
    require ('../../../Handlers/DBCONNECT.php');

    $json = Array();
    $sql = "SELECT DISTINCT O.ID, CT.ID AS CART_ID, O.UNIQUE_ID, CONCAT(P.FIRST_NAME,' ',P.LAST_NAME) AS PERSON, O.ORDER_DATE_TIME, PY.TYPE, CT.TOTAL
            FROM ORDERS O 
            INNER JOIN PERSONS P ON O.PERSON_ID = P.ID
            INNER JOIN CARTS CT ON O.CART_ID = CT.ID
            INNER JOIN CART_DETAILS CTD ON CT.ID = CTD.CART_ID
            INNER JOIN PAYMENT_TYPES PY ON O.PAYMENT_TYPE_ID = PY.ID
            WHERE ORDER_STATUS_ID = 1";
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

            $sql = "SELECT COUNT(CTD.ID) AS NUMBER_OF_PRODUCTS FROM CART_DETAILS CTD
                    INNER JOIN CARTS CT ON CTD.CART_ID = CT.ID
                    WHERE CT.ID = '".$row['CART_ID']."'";
            $result3 = mysqli_query($con,$sql);
            $rows3 = mysqli_num_rows($result3);
            if($rows3 > 0){
                while($row3 = mysqli_fetch_array($result3)){
                    $json[$i]['NUMBER_OF_PRODUCTS'] = $row3['NUMBER_OF_PRODUCTS'];
                }
            }

            $sql = "SELECT C.CURRENCY FROM PRODUCTS P
                    INNER JOIN CART_DETAILS CTD ON P.ID = CTD.PRODUCT_ID
                    INNER JOIN CARTS CT ON CTD.CART_ID = CT.ID
                    INNER JOIN CURRENCIES C ON P.CURRENCY_ID = C.ID
                    WHERE CT.ID = '".$row['CART_ID']."' LIMIT 1";
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0){
                while($row2 = mysqli_fetch_array($result2)){
                    $json[$i]['CURRENCY'] = $row2['CURRENCY'];
                }
            }
            $i++;
        }
    }
    echo json_encode($json);
?>