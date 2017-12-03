<?php
require ('../Handlers/DBCONNECT.php');

$json = Array();
$sql = "SELECT COUNT(ID) AS Count FROM persons WHERE PERSON_TYPE_ID = 2";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['USERS_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM product_categories WHERE IS_ACTIVE = 1";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['CATEGORIES_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM product_categories";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['ALL_CATEGORIES_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM products";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['PRODUCTS_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 1";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['PEND_ORDERS_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 2";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['QUEUE_ORDERS_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 3";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['SHIP_ORDERS_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_COUNT'] = $row['Count'];
}

$sql = "SELECT SUM(C.TOTAL) AS TOTAL FROM carts C
        INNER JOIN orders O ON C.ID = O.CART_ID
        WHERE O.ORDER_STATUS_ID = 4";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)){
        if(is_null($row['TOTAL'])){
           $json['TOTAL_INCOME'] = "0.00";
        }
        else{
            $json['TOTAL_INCOME'] = $row['TOTAL'];
        }
    }
}

$sql = "SELECT SUM(C.TOTAL) AS TOTAL FROM carts C
        INNER JOIN orders O ON C.ID = O.CART_ID
        WHERE O.ORDER_STATUS_ID = 4 
        AND O.ORDER_DATE_TIME >= DATE_FORMAT(CURRENT_DATE - INTERVAL 2 MONTH , '%Y/%m/01')
        AND O.ORDER_DATE_TIME < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)){
        if(is_null($row['TOTAL'])){
            $json['LAST_2_MONTHLY_INCOME'] = "0.00";
        }
        else{
            $json['LAST_2_MONTHLY_INCOME'] = $row['TOTAL'];
        }
    }
}

$sql = "SELECT SUM(C.TOTAL) AS TOTAL FROM carts C
        INNER JOIN orders O ON C.ID = O.CART_ID
        WHERE O.ORDER_STATUS_ID = 4 
        AND O.ORDER_DATE_TIME >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH , '%Y/%m/01')
        AND O.ORDER_DATE_TIME < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)){
        if(is_null($row['TOTAL'])){
            $json['LAST_MONTHLY_INCOME'] = "0.00";
        }
        else{
            $json['LAST_MONTHLY_INCOME'] = $row['TOTAL'];
        }
    }
}

$sql = "SELECT SUM(C.TOTAL) AS TOTAL FROM carts C
        INNER JOIN orders O ON C.ID = O.CART_ID
        WHERE O.ORDER_STATUS_ID = 4 
        AND O.ORDER_DATE_TIME >= DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')
        AND O.ORDER_DATE_TIME < NOW()";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)){
        if(is_null($row['TOTAL'])){
            $json['CURRENT_MONTHLY_INCOME'] = "0.00";
        }
        else{
            $json['CURRENT_MONTHLY_INCOME'] = $row['TOTAL'];
        }
    }
}

$json['LAST_MONTH'] = strtoupper(date("M y", strtotime(date('F') . " last month")));

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 8 WEEK) and DATE_SUB(NOW(),INTERVAL 7 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W1_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 7 WEEK) and DATE_SUB(NOW(),INTERVAL 6 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W2_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 6 WEEK) and DATE_SUB(NOW(),INTERVAL 5 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W3_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 5 WEEK) and DATE_SUB(NOW(),INTERVAL 4 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W4_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 4 WEEK) and DATE_SUB(NOW(),INTERVAL 3 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W5_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 3 WEEK) and DATE_SUB(NOW(),INTERVAL 2 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W6_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
        ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 2 WEEK) and DATE_SUB(NOW(),INTERVAL 7 DAY)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W7_COUNT'] = $row['Count'];
}

$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND ORDER_DATE_TIME > DATE_SUB(NOW(), INTERVAL 7 DAY)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $json['DEL_ORDERS_W8_COUNT'] = $row['Count'];
}
echo json_encode($json);
?>