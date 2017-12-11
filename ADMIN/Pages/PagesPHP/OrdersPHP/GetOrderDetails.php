<?php
    require ('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $ORDER_ID = $_GET['id'];

    $json = Array();
    $sql = "SELECT DISTINCT O.ID, O.SHIP_DATE_TIME, CT.ID AS CART_ID, O.UNIQUE_ID, CONCAT(P.FIRST_NAME,' ',P.LAST_NAME) AS PERSON, OS.STATUS, O.ORDER_DATE_TIME, PY.TYPE, CT.TOTAL
            FROM orders O 
            INNER JOIN persons P ON O.PERSON_ID = P.ID
            INNER JOIN carts CT ON O.CART_ID = CT.ID
            INNER JOIN cart_details CTD ON CT.ID = CTD.CART_ID
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

            $sql = "SELECT P.ID, P.SKU_ID, C.CURRENCY, P.NAME, CTD.QUANTITY, CTD.PRICE FROM cart_details CTD
                    INNER JOIN carts CT ON CTD.CART_ID = CT.ID
                    INNER JOIN products P ON CTD.PRODUCT_ID = P.ID
                    INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
                    WHERE CT.ID = '".$row['CART_ID']."'";
            $result3 = mysqli_query($con,$sql);
            $rows3 = mysqli_num_rows($result3);
            if($rows3 > 0){
                $j = 0;
                while($row3 = mysqli_fetch_array($result3)){
                    $json['DETAILS'][$j]['SKU_ID'] = $row3['SKU_ID'];
                    $json['DETAILS'][$j]['NAME'] = $row3['NAME'];
                    $json['DETAILS'][$j]['QUANTITY'] = $row3['QUANTITY'];
                    $json['DETAILS'][$j]['PRICE'] = $row3['PRICE'];
                    $json['DETAILS'][$j]['CURRENCY'] = $row3['CURRENCY'];

                    $sql = "SELECT ID,IMAGE_PATH FROM products_images WHERE PRODUCT_ID = '".$row3['ID']."'";
                    $result4 = mysqli_query($con,$sql);
                    $rows4 = mysqli_num_rows($result4);
                    $IMAGE = '';
                    $IMAGE_ID = '';
                    if($rows4 > 0){
                        while($row4 = mysqli_fetch_array($result4)){
                            $IMAGE = $row4['IMAGE_PATH'];
                            $IMAGE_ID = $row4['ID'];
                            break;
                        }
                    }
                    $json['DETAILS'][$j]['IMAGE_ID'] = $IMAGE_ID;
                    $json['DETAILS'][$j]['IMAGE'] = $IMAGE;
                    $j++;
                }
            }

            $sql = "SELECT C.CURRENCY FROM products P
                    INNER JOIN cart_details CTD ON P.ID = CTD.PRODUCT_ID
                    INNER JOIN carts CT ON CTD.CART_ID = CT.ID
                    INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
                    WHERE CT.ID = '".$row['CART_ID']."' LIMIT 1";
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0){
                while($row2 = mysqli_fetch_array($result2)){
                    $json['CURRENCY'] = $row2['CURRENCY'];
                }
            }
        }
    }
    echo json_encode($json);
?>